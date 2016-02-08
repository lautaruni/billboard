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
                        {!! Form::hidden('special_form','showdates') !!}
                        <div id="event-form" class="col-sm-8">
                              <h2>Fechas</h2>
                              @if(empty($showdates))
                              <div class="form-group col-sm-12 showdate-group">
                                    <div class="row col-sm-12">
                                          <div class="col-sm-1 pull-right">
                                                <a href="#" onclick="$(this).parent().parent().parent('.showdate-group').remove()" class="btn-remove"><i class="fa fa-remove"></i></a>
                                          </div>
                                          <div class="clearfix"></div>
                                          <div class="col-sm-6">
                                                {!! Form::label('Fecha inicio',null) !!}
                                                {!! Form::date('date_start[]',null,['class'=>'input-lg','Placeholder'=>'Fecha de inicio']) !!}
                                          </div>
                                          <!--<div class="col-sm-6">
                                                {!! Form::label('Fecha Fin',null) !!}
                                                {!! Form::date('date_end[]',null,['class'=>'input-lg','Placeholder'=>'Fecha de fin']) !!}
                                          </div>-->
                                    </div>
                                    <div class="row col-sm-12">
                                          <div class="col-sm-6">
                                            {!! Form::label('Hora inicio',null) !!}
                                            <input type="time" name="hour_start[]" value="12:00"></input>
                                          </div>
                                          <div class="col-sm-6">
                                                {!! Form::label('Hora Fin',null) !!}
                                                <input type="time" name="hour_end[]" value="13:00"></input>
                                          </div>
                                    </div>
                              </div>
                              @else
                                    @foreach($showdates as $showdate)
                                    <div class="form-group col-sm-12 showdate-group">
                                          <div class="row col-sm-12">
                                                <div class="col-sm-1 pull-right">
                                                      <a href="#" onclick="$(this).parent().parent().parent('.showdate-group').remove()" class="btn-remove"><i class="fa fa-remove"></i></a>
                                                </div>
                                                <div class="clearfix"></div>
                                                 <div class="col-sm-6">
                                                      {!! Form::label('Fecha inicio',null) !!}
                                                      {!! Form::date('date_start[]',date("Y-m-d",strtotime($showdate->date_start)),['class'=>'input-lg','Placeholder'=>'Fecha de inicio']) !!}
                                                </div>
                                                <!--<div class="col-sm-6">
                                                      {!! Form::label('Fecha Fin',null) !!}
                                                      {!! Form::date('date_end[]',date("Y-m-d",strtotime($showdate->date_end)),['class'=>'input-lg','Placeholder'=>'Fecha de fin']) !!}
                                                </div>-->
                                          </div>
                                          <div class="row col-sm-12">
                                                <div class="col-sm-6">
                                                  {!! Form::label('Hora inicio',null) !!}
                                                  <input type="time" name="hour_start[]" value="{!! $showdate->hour_start !!}"></input>
                                                </div>
                                                <div class="col-sm-6">
                                                      {!! Form::label('Hora Fin',null) !!}
                                                      <input type="time" name="hour_end[]" value="{!! $showdate->hour_end !!}"></input>
                                                </div>
                                          </div>
                                    </div>
                                    @endforeach
                              @endif
                        </div>
                            <div class="col-sm-4">
                                <a href="#" onclick="$('.showdate-group').last().clone().appendTo('#event-form');" class="btn btn-info">Agregar fecha</a>
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