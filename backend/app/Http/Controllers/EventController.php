<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\BackendController;
use Session;
use Redirect;

use App\Company;
use App\venue;
use App\Rol;
use App\Person;
use App\Category;
use App\Event;
use App\Category_to_Event;
use App\People_to_Rols;
use App\EventDate;

class EventController extends BackendController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataView=array();
        $dataView['page_title']="Eventos";
        $dataView['events']=event::all();
        return view('event.index',$dataView);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $dataView=array();
        $dataView['page_title']="Crear un Evento";
        $dataView['venues']=venue::getVenues();
        $dataView['companies']=company::getCompanies();
        $dataView['categories']=category::all();
        return view('event.create',$dataView);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $friendly_url=$this->setFriendlyUrl($request->input('title'));
        // if has file
        if($request->hasFile('poster')){
            $image_name=$this->uploadImage($request->file('poster'),'events',$friendly_url);
        }else{
            $image_name="none.jpg";
        }
        // Event Data
        Event::create([
            'title'=>$request->input('title'),
            'friendly_url'=>$friendly_url,
            'poster'=>$image_name,
            'description'=>$request->input('description'),
            'mature'=>$request->input('mature'),
            'price'=>$request->input('price'),
            'quota'=>$request->input('quota'),
            'status'=>$request->input('status'),
            'company_id'=>$request->input('company_id'),
            'venue_id'=>$request->input('venue_id')
        ]);
        $id=Event::getLastID();
        // Save Categories rel.
        if(!empty($request->input('category'))){
            foreach($request->input('category') as $cat){
                \App\Category_to_Event::create([
                    'category_id'=>$cat,
                    'event_id'=>$id
                ]);
            }
        }
        Session::flash('message','Evento agregado con éxito');
        return redirect('events');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dataView=array();
        $dataView['page_title']="Editar un Evento";
        $dataView['event']=Event::find($id);
        $dataView['venues']=venue::getVenues();
        $dataView['companies']=company::getCompanies();
        $dataView['categories']=category::all();
        // make a array of categories related to this event.
        $categories_inEvent=array();
        foreach(Category_to_Event::getAllRelByEventID($id) as $rel){
            $categories_inEvent[]=$rel->category_id;
        }
        $dataView['categories_inEvent']=$categories_inEvent;
        return view('event.edit',$dataView);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // si es un update comun
        if($request->input('special_form')==""){
            $event = Event::find($id);
            $friendly_url=$event->friendly_url;
            $event->fill($request->all());
            // if has file
            if($request->hasFile('poster')){
                $image_name=$this->uploadImage($request->file('poster'),'events',$friendly_url);
                $event->poster=$image_name;
            }
            $event->save();
            // save categories rel
            if(!empty($request->input('category'))){
                // first remove all rels
                Category_to_Event::deleteAllRelByEventId($id);
                foreach($request->input('category') as $cat){
                    Category_to_Event::create([
                        'category_id'=>$cat,
                        'event_id'=>$id
                    ]);
                }
            }
        }else{
            if($request->input('special_form')=='showdates'){
                // first delete all
                Eventdate::deleteAllByEventID($id);
                // insert
                $qty=count($request->input('date_start'));
                for($i=0;$i<$qty;$i++){
                    Eventdate::create([
                        'event_id'=>$id,
                        'date_start'=>date("Y-m-d H:i:s",strtotime($request->input('date_start')[$i]." ".$request->input('hour_start')[$i].":00")),
                        'date_end'=>date("Y-m-d H:i:s",strtotime($request->input('date_start')[$i]." ".$request->input('hour_end')[$i].":00")),
                        'hour_start'=>$request->input('hour_start')[$i],
                        'hour_end'=>$request->input('hour_end')[$i],
                        'status'=>1,
                    ]);
                }
            }elseif($request->input('special_form')=='casting'){
                // first delete all
                People_to_Rols::deleteAllByEventID($id);
                // for each element
                $qty=count($request->input('rol'));
                for($i=0;$i<$qty;$i++){
                    // select People
                    $person=Person::getPersonByName(ucfirst(strtolower($request->input('firstname')[$i])),ucfirst(strtolower($request->input('lastname')[$i])));
                    if(empty($person)){
                        // guardo la persona y traigo el ultimo id
                        Person::create([
                        'user_id'=>0,
                        'firstname'=>$request->input('firstname')[$i],
                        'lastname'=>$request->input('lastname')[$i],
                        'status'=>1
                        ]);
                        $person=Person::getLastID();
                    }else{
                        $person=$person[0]->person_id;
                    }
                    // inser into rel table
                    People_to_Rols::create([
                        'event_id'=>$id,
                        'rol_id'=>$request->input('rol')[$i],
                        'person_id'=>$person
                    ]);
                }
            }
        }
        Session::flash('message','Evento actualizado Correctamente');
        return Redirect::to('events');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        foreach($request->input('to_delete') as $item_id){
            // delete file if exists
            $image=Event::getImage($item_id);
            $this->deleteImage('events',$image);
            Event::destroy($item_id);
            // delete all rels
            if(Category_to_Event::countCategoriesByEventID($item_id)>0){
                Category_to_Event::deleteAllRelByEventId($item_id);
            }
            if(People_to_Rols::countCastingByEventID($item_id)>0){
                People_to_Rols::deleteAllRelByEventId($item_id);
            }
            if(EventDate::countDatesByEventID($item_id)>0){
                EventDate::deleteAllByEventID($item_id);
            }
        }
        Session::flash('message','Evento borrado Correctamente');
        return Redirect::to('events');
    }

    /*
    * Add showdates to one event
    */
    public function showdates($id){
        $dataView=array();
        $dataView['event']=Event::find($id);
        $dataView['page_title']="agregar Fechas al Evento: ".$dataView['event']->title;
        // get EventDates
        $dataView['showdates']=EventDate::getEventDatesByEventID($id);
        // create hour array
        $hours=array();
        for($i=0;$i<24;$i++){
            if($i<10){
                $i='0'.$i;
            }
            for($j='00';$j<60;$j+=15){
                $hours[$i.':'.$j]=$i.':'.$j;
            }
        }
        $dataView['hours']=$hours;
        return view('event.showdates',$dataView);
    }

    /*
    * Add peoples and rols to one event
    */
    public function casting($id){
        $dataView=array();
        $dataView['event']=Event::find($id);
        $dataView['rols']=Rol::getRols();
        $dataView['page_title']="agregar elenco al Evento: ".$dataView['event']->title;
        $dataView['casts']=People_to_Rols::getPeopleToRolsByEventID($id);
        return view('event.casting',$dataView);
    }
}
