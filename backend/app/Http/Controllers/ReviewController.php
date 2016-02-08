<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\BackendController;
use App\Review;
use Session;
use Redirect;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataView=array();
        $dataView['page_title']="Opiniones";
        $dataView['reviews']=review::all();
        return view('review.index',$dataView);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $dataView=array();
        $dataView['page_title']="Agregar una opinión";
        return view('review.create',$dataView);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        review::create([
            'name'=>$request->input('name')
            ]);
        Session::flash('message','Opinión agregada con éxito');
        return redirect('reviews');
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
        $dataView['page_title']="Editar un Rol";
        $dataView['rol']=review::find($id);
        return view('review.edit',$dataView);
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
        $rol = review::find($id);
        $rol->fill($request->all());
        $rol->save();
        Session::flash('message','Rol actualizado Correctamente');
        return Redirect::to('reviews');
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
            review::destroy($item_id);
        }
        Session::flash('message','Rol borrado Correctamente');
        return Redirect::to('reviews');
    }
}
