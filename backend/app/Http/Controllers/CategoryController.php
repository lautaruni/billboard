<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\BackendController;

use App\Category;

use Session;
use Redirect;

class CategoryController extends BackendController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataView=array();
        $dataView['page_title']="Categorías";
        $dataView['categories']=Category::all();
        return view('category.index',$dataView);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $dataView=array();
        $dataView['page_title']="Agregar una Categoría";
        $dataView['parents']=category::getCategoriesParent();
        return view('category.create',$dataView);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        category::create([
            'user_id'=>0,
            'name'=>$request->input('name'),
            'description'=>$request->input('description'),
            'parent_id'=>$request->input('parent'),
            'status'=>$request->input('status')
            ]);
        Session::flash('message','Categoría agregada con éxito');
        return redirect('categories');
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
        $dataView['page_title']="Editar una Categoría";
        $dataView['category']=category::find($id);
        $dataView['parents']=category::getCategoriesParent($id);
        return view('category.edit',$dataView);
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
        $category = category::find($id);
        $category->fill($request->all());
        $category->save();
        Session::flash('message','Categoría actualizada Correctamente');
        return Redirect::to('categories');
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
            Category::destroy($item_id);
        }
        Session::flash('message','Categoría borrada Correctamente');
        return Redirect::to('categories');
    }
}
