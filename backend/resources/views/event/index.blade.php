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
                    {!! Form::open(['route'=>['events.destroy',0],'method'=>'DELETE']) !!}
                    <div class="page-content">
                        <div id="page_bar">
                            <div class="col-sm-4">
                                <p> SEARCH</p>
                            </div>
                            <div class="col-sm-8">
                                <div class="btn-group pull-right">
                                    {!! Form::submit('Borrar elementos seleccionados',['class'=>'btn btn-danger','onclick'=>'return confirm("¿Seguro que quieres borrarlo?")']) !!}
                                    <a href="{!! URL::to('events/create') !!}" class="btn btn-success" ><i class="fa fa-plus-circle"></i> Agregar Evento</a>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="panel panel-violet">
                            <div class="panel-heading">Lista</div>
                                <div class="panel-body">
                                    <table id="event_list" class="table table-hover table-striped">
                                        <thead>
                                            <th>#</th>
                                            <th>Nombre</th>
                                            <th>Lugar</th>
                                            <th>Compañía</th>
                                            <th>Elenco</th>
                                            <th>Funciones</th>
                                            <th>Estado</th>
                                            <th><i class="fa fa-hourglass-end"></i></th>
                                            <th>Opciones</th>
                                        </thead>
                                        @foreach($events as $event)
                                            <tr>
                                                <td>{!! Form::checkbox('to_delete[]',$event->event_id) !!}</td>
                                                <td>{!! $event->title !!}</td>
                                                <td>{!! $event->venue($event->venue_id)->name !!}</td>
                                                <td>{!! $event->company($event->company_id)->name !!}</td>
                                                <td><a href="{!! Url::to('events/casting/'.$event->event_id.'/') !!}" class="btn btn-warning" ><i class="fa fa-group"></i> {!! $event->countCasting($event->event_id) !!}</a></td>
                                                <td><a href="{!! Url::to('events/showdates/'.$event->event_id.'/') !!}" class="btn btn-warning" ><i class="fa fa-calendar"></i> {!! $event->countDates($event->event_id) !!}</a></td>
                                                <td>{!! $event->status !!}</td>
                                                <td><span class="badge">{!! $event->getRemainingDates($event->event_id) !!}</span></td>
                                                <td><div class="btn-group">
                                                    <a href="{!! URL::to('events/'.$event->event_id.'/edit') !!}" class="btn btn-info" >Editar</a>
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