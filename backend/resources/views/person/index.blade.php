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
                    @if(Session::has('message'))
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        {!! Session::get('message') !!}
                    </div>
                    @endif
                    <!--BEGIN CONTENT-->
                    {!! Form::open(['route'=>['people.destroy',0],'method'=>'DELETE']) !!}
                    <div class="page-content">
                        <div id="page_bar">
                            <div class="col-sm-4">
                                <p> SEARCH</p>
                            </div>
                            <div class="col-sm-8">
                                <div class="btn-group pull-right">
                                    {!! Form::submit('Borrar elementos seleccionados',['class'=>'btn btn-danger','onclick'=>'return confirm("¿Seguro que quieres borrarlo?")']) !!}
                                    <a href="{!! URL::to('people/create') !!}" class="btn btn-success" ><i class="fa fa-plus-circle"></i> Agregar Persona</a>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="panel panel-violet">
                            <div class="panel-heading">Lista</div>
                                <div class="panel-body">
                                    <table id="person_list" class="table table-hover table-striped">
                                        <thead>
                                            <th>#</th>
                                            <th>Nombre</th>
                                            <th>Apellido</th>
                                            <th>Estado</th>
                                            <th>Opciones</th>
                                        </thead>
                                        @foreach($people as $person)
                                            <tr>
                                                <td>{!! Form::checkbox('to_delete[]',$person->person_id) !!}</td>
                                                <td>{!! $person->firstname !!}</td>
                                                <td>{!! $person->lastname !!}</td>
                                                <td>{!! $person->status !!}</td>
                                                <td><div class="btn-group">
                                                    <a href="{!! URL::to('people/'.$person->person_id.'/edit') !!}" class="btn btn-info" >Editar</a>
                                                </div></td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                        {!! Form::close() !!}
                        <!--END PAGE CONTENT -->
                    </div>
                    <!--END CONTENT-->
    @endsection