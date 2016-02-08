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
                        {!! Form::model($event,['route'=>['events.update',$event->event_id],'method'=>'PUT']) !!}
                        {!! Form::hidden('special_form','casting') !!}
                        <div id="event-form" class="col-sm-8">
                              <h2>Elenco</h2>
                              @if(empty($casts))
                                <div class="col-sm-12 cast-group">
                                    <div class="col-sm-12">
                                        <div class="col-sm-1 pull-right">
                                            <a href="#" onclick="$(this).parent().parent().parent('.cast-group').remove()" class="btn-remove"><i class="fa fa-remove"></i></a>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <label>Rol</label><br/>
                                            {!! Form::select('rol[]', $rols,null,['class'=>'col-sm-12 input-lg']) !!}    
                                        </div>
                                        <div class="form-group col-sm-8">
                                            <label>Persona</label><br/>
                                            {!! Form::text('firstname[]',null,['placeholder'=>'Nombre','class'=>'col-sm-6']) !!}
                                            {!! Form::text('lastname[]',null,['placeholder'=>'Apellido','class'=>'col-sm-6']) !!}
                                        </div>
                                    </div>
                                </div>
                              @else
                                @foreach($casts as $cast)
                                    <div class="col-sm-12 cast-group">
                                        <div class="col-sm-12">
                                            <div class="col-sm-1 pull-right">
                                                <a href="#" onclick="$(this).parent().parent().parent('.cast-group').remove()" class="btn-remove"><i class="fa fa-remove"></i></a>
                                            </div>
                                            <div class="form-group col-sm-4">
                                                <label>Rol</label><br/>
                                                {!! Form::select('rol[]', $rols,$cast->rol_id,['class'=>'col-sm-12 input-lg']) !!}    
                                            </div>
                                            <div class="form-group col-sm-8">
                                                <label>Persona</label><br/>
                                                {!! Form::text('firstname[]',$cast->firstname,['placeholder'=>'Nombre','class'=>'col-sm-6']) !!}
                                            {!! Form::text('lastname[]', $cast->lastname,['placeholder'=>'Apellido','class'=>'col-sm-6']) !!}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                              @endif
                        </div>
                            <div class="col-sm-4">
                                <a href="#" onclick="$('.cast-group').last().clone().appendTo('#event-form');" class="btn btn-info">Agregar Elenco</a>
                            </div>
                            <div class="col-sm-12">
                                <div class="pull-right btn-group">
                                    <button type="button" onclick="window.location='{!! URL::to('events/') !!}'" class="btn btn-danger">Cancelar</button>
                                    {!! Form::submit('Guardar',['class'=>'btn btn-success']) !!}
                                </div>
                            </div>
                        {!! Form::close() !!}
                        <div class="clearfix"></div>
                        <!--END PAGE CONTENT -->
                    </div>
                    <!--END CONTENT-->
    @endsection