<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\BackendController;
use App\Person;
use Session;
use Redirect;

class PersonController extends BackendController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataView=array();
        $dataView['page_title']="Personas";
        $dataView['people']=person::all();
        return view('person.index',$dataView);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $dataView=array();
        $dataView['page_title']="Agregar una Persona";
        return view('person.create',$dataView);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        person::create([
            'user_id'=>0,
            'firstname'=>$request->input('firstname'),
            'lastname'=>$request->input('lastname'),
            'status'=>$request->input('status')
            ]);
        Session::flash('message','Persona agregada con éxito');
        return redirect('people');
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
        $dataView['page_title']="Editar una Persona";
        $dataView['person']=person::find($id);
        return view('person.edit',$dataView);
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
        $person = person::find($id);
        $person->fill($request->all());
        $person->save();
        Session::flash('message','Persona actualizada Correctamente');
        return Redirect::to('people');
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
            Person::destroy($item_id);
        }
        Session::flash('message','Persona borrado Correctamente');
        return Redirect::to('people');
    }
}
