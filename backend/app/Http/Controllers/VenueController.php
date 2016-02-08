<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\BackendController;
use App\Venue;
use Session;
use Redirect;

class VenueController extends BackendController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataView=array();
        $dataView['page_title']="Lugares de encuentro";
        $dataView['venues']=Venue::all();
        return view('venue.index',$dataView);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $dataView=array();
        $dataView['page_title']="Agregar una compañía";
        return view('venue.create',$dataView);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $friendly_url=$this->setFriendlyUrl($request->input('name'));
        // if has file
        if($request->hasFile('image')){
            $image_name=$this->uploadImage($request->file('image'),'venues',$friendly_url);
        }else{
            $image_name="none.jpg";
        }
        venue::create([
            'name'=>$request->input('name'),
            'friendly_url'=>$friendly_url,
            'image'=>$image_name,
            'description'=>$request->input('description'),
            'phone'=>$request->input('phone'),
            'web'=>$request->input('web'),
            'email'=>$request->input('email'),
            'location'=>$request->input('location'),
            'coordinates'=>$request->input('coordinates'),
            'status'=>$request->input('status')
            ]);
        Session::flash('message','Lugar de encuentro agregado con éxito');
        return redirect('venues');
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
        $dataView['page_title']="Editar un Lugar de encuentro";
        $dataView['venue']=venue::find($id);
        return view('venue.edit',$dataView);
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
        $venue = venue::find($id);
        $friendly_url=$venue->friendly_url;
        $venue->fill($request->all());
        // if has file
        if($request->hasFile('image')){
            $image_name=$this->uploadImage($request->file('image'),'venues',$friendly_url);
            $venue->image=$image_name;
        }
        $venue->save();
        Session::flash('message','Lugar de encuentro actualizada Correctamente');
        return Redirect::to('venues');
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
            $image=Venue::getImage($item_id);
            $this->deleteImage('venues',$image);
            Venue::destroy($item_id);
        }
        Session::flash('message','Lugar de encuentro borrado Correctamente');
        return Redirect::to('venues');
    }

}
