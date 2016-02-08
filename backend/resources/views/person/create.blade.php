@extends('main')
    @section('page-content')
                <!--BEGIN PAGE WRAPPER-->
                <div id="page-wrapper">
                    <!--BEGIN TITLE & BREADCRUMB PAGE-->
                    <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
                        <div class="page-header pull-left">
                            <div class="page-title">{!! $page_title !!}</div>
                        </div>
                        <!--<ol class="breadcrumb page-breadcrumb pull-right">
                            <li><i class="fa fa-home"></i>&nbsp;<a href="dashboard.html">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                            <li class="hidden"><a href="#">pagina </a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                            <li class="active"> pagina </li>
                        </ol>-->
                        <div class="clearfix">
                        </div>
                    </div>
                    <!--END TITLE & BREADCRUMB PAGE-->
                    <!--BEGIN CONTENT-->
                    <div class="page-content">
                        {!! Form::open(['route'=>'people.store','method'=>'POST']) !!}
                            <div class="col-sm-8">
                                <div class="col-sm-12">
                                    {!! Form::label('Nombre',null) !!}
                                    {!! Form::text('firstname',null,['class'=>'col-sm-12 input-lg','placeholder'=>'Ej: Juan Carlos']) !!}
                                </div>
                                <div class="col-sm-12">
                                    {!! Form::label('Apellido',null) !!}
                                    {!! Form::text('lastname',null,['class'=>'col-sm-12 input-lg','placeholder'=>'Ej: Mateiko']) !!}
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="col-sm-12">
                                    {!! Form::label('Estado',null) !!}<br/>
                                    {!! Form::select('status', array('1' => 'Habilitado', '0' => 'Deshabilitado'),'1',['class'=>'input-lg']) !!}
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="pull-right btn-group">
                                    <button type="button" onclick="window.location='{!! URL::to('people/') !!}'" class="btn btn-danger">Cancelar</button>
                                    {!! Form::submit('Guardar',['class'=>'btn btn-success']) !!}
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        {!! Form::close() !!}
                        <!--END PAGE CONTENT -->
                    </div>
                    <!--END CONTENT-->
    @endsection