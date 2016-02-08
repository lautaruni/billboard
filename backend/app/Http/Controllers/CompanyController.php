<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\BackendController;
use App\Company;
use Session;
use Redirect;

class CompanyController extends BackendController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataView=array();
        $dataView['page_title']="Compañías";
        $dataView['companies']=Company::all();
        return view('company.index',$dataView);
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
        return view('company.create',$dataView);
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
            $image_name=$this->uploadImage($request->file('image'),'companies',$friendly_url);
        }else{
            $image_name="none.jpg";
        }
        Company::create([
            'name'=>$request->input('name'),
            'friendly_url'=>$friendly_url,
            'image'=>$image_name,
            'description'=>$request->input('description'),
            'phone'=>$request->input('phone'),
            'web'=>$request->input('web'),
            'email'=>$request->input('email'),
            'status'=>$request->input('status')
            ]);
        Session::flash('message','Compañía agregada con éxito');
        return redirect('companies');
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
        $dataView['page_title']="Editar una compañía";
        $dataView['company']=Company::find($id);
        return view('company.edit',$dataView);
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
        $company = Company::find($id);
        $friendly_url=$company->friendly_url;
        $company->fill($request->all());
        // if has file
        if($request->hasFile('image')){
            $image_name=$this->uploadImage($request->file('image'),'companies',$friendly_url);
            $company->image=$image_name;
        }
        $company->save();
        Session::flash('message','Compañía actualizada Correctamente');
        return Redirect::to('companies');
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
            $image=Company::getImage($item_id);
            $this->deleteImage('venues',$image);
            Company::destroy($item_id);
        }
        Session::flash('message','Compañía borrada Correctamente');
        return Redirect::to('companies');
    }
}
