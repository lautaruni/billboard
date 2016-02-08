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
                        {!! Form::model($venue,['route'=>['venues.update',$venue->venue_id],'method'=>'PUT','files'=>true]) !!}
                            <div class="col-sm-8">
                                <div class="col-sm-12">
                                    {!! Form::label('Nombre',null) !!}
                                    {!! Form::text('name',null,['class'=>'col-sm-12 input-lg','placeholder'=>'Ej: Teatro el viejo resongón']) !!}
                                </div>
                                <div class="col-sm-12">
                                    {!! Form::label('Friendly url',null) !!}
                                    {!! Form::text('friendly_url',null,['id'=>'event-friendlyurl','class'=>'col-sm-12','disabled'=>'disabled']) !!}
                                </div>
                                <div class="col-sm-12">
                                    {!! Form::label('Dirección',null) !!}
                                    {!! Form::text('location',null,['class'=>'col-sm-12','placeholder'=>'Ej: 140 N3020 e 12 y 13']) !!}
                                </div>
                                <div class="col-sm-12">
                                    {!! Form::label('Descripción',null) !!}
                                    {!! Form::textarea('description',null,['class'=>'col-sm-12','placeholder'=>'Descripción o historia del lugar']) !!}
                                </div>
                                <div class="col-sm-12">
                                    {!! Form::label('Coordenadas',null) !!}
                                    {!! Form::text('coordinates',null,['class'=>'col-sm-12','placeholder'=>'Para google maps']) !!}
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="col-sm-12">
                                    {!! Form::label('Poster',null) !!}
                                    <input type="file" id="poster" name="image" onchange="previewFile()"></input>
                                    <img id="poster_preview" src="{!! URL::to('images/venues/'.$venue->image) !!}" height="200" alt="">
                                </div>
                                <div class="col-sm-12">
                                    {!! Form::label('Teléfono',null) !!}
                                    {!! Form::text('phone',null,['class'=>'col-sm-12','placeholder'=>'Ej: +54 221 15 5035852']) !!}
                                </div>
                                <div class="col-sm-12">
                                    {!! Form::label('Web',null) !!}
                                    {!! Form::text('web',null,['class'=>'col-sm-12','placeholder'=>'Ej: www.lugar.com.ar']) !!}
                                </div>
                                <div class="col-sm-12">
                                    {!! Form::label('Email',null) !!}
                                    {!! Form::email('email',null,['class'=>'col-sm-12','placeholder'=>'Ej: email@lugar.com']) !!}
                                </div>
                                <div class="col-sm-12">
                                    {!! Form::label('Estado',null) !!}<br/>
                                    {!! Form::select('status', array('1' => 'Habilitado', '0' => 'Deshabilitado'),null,['class'=>'input-lg']) !!}
                                </div>
                                <div class="col-sm-12">
                                    <div class="pull-right btn-group">
                                        <button type="button" onclick="window.location='{!! URL::to('venues/') !!}'" class="btn btn-danger">Cancelar</button>
                                        {!! Form::submit('Guardar',['class'=>'btn btn-success']) !!}
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        {!! Form::close() !!}
                        <!--END PAGE CONTENT -->
                    </div>
                    <!--END CONTENT-->
        <script typ="text/javascript">
        function previewFile(){
           var preview = document.getElementById('poster_preview'); //selects the query named img
           var file    = document.querySelector('input[type=file]').files[0]; //sames as here
           var reader  = new FileReader();

           reader.onloadend = function () {
               preview.src = reader.result;
           }

           if (file) {
               reader.readAsDataURL(file); //reads the data as a URL
           } else {
               preview.src = "";
           }
        }

        </script>

    @endsection