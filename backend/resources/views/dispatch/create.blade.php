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
                        {!! Form::open(['route'=>'events.store','method'=>'POST','files'=>true]) !!}
                            <div id="event-form" class="col-sm-8">
                                <div class="form-group col-sm-12">
                                    <h3>Título</h3>
                                    {!! Form::text('title',null,['class'=>'input-lg col-sm-12','placeholder'=>'EJ: Juanito y los clonosaurios']) !!}
                                </div>
                                <div class="form-group col-sm-12">
                                    <label>Friendly url</label><br />
                                    {!! Form::text('friendly_url',null,['id'=>'event-friendlyurl','class'=>'col-sm-12','disabled'=>'disabled']) !!}
                                </div>
                                <div class="form-group col-sm-12">
                                    <h4>Descripción</h4>
                                   {!! Form::textarea('description',null,['class'=>'col-sm-12 summernote','placeholder'=>'Descripción del espectáculo']) !!}
                                </div>
                                <div class="col-sm-12">
                                    <h3>Sala y Compañía</h3>
                                    <div class="form-group col-sm-6">
                                        <label>Lugar de encuentro:</label><br/>
                                        {!! Form::select('venue_id', $venues,null,['class'=>'col-sm-12 input-lg']) !!}    
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label>Compañía:</label><br/>
                                        {!! Form::select('company_id',$companies,null,['class'=>'col-sm-12 input-lg']) !!}    
                                    </div>
                                </div>
                                <div class="form-group col-sm-12">
                                    <h2>Categorias</h2>
                                    @foreach($categories as $category)
                                        <label>{!! Form::checkbox('category[]', $category->category_id) !!}{!! $category->name !!}</label>
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group col-sm-12">
                                    <label>Image</label><br/>
                                    <input type="file" id="poster" name="poster" onchange="previewFile()"></input>
                                    <img id="poster_preview" src="" height="200" alt="">
                                </div>
                                <div class="form-group col-sm-12">
                                    <label>Precio</label><br />
                                    {!! Form::text('price',null,['placeholder'=>'0']) !!}
                                </div>
                                <div class="form-group col-sm-12">
                                    <label>Localidades disponibles</label><br />
                                    {!! Form::text('quota',null,['class'=>'input-lg','placeholder'=>'Localidades disponibles']) !!}
                                </div>
                                <div class="form-group col-sm-12">
                                    <label>¿Para mayores?</label><br/>
                                    {!! Form::select('mature', array('0' => 'No', '1' => 'Sí'),null,['class'=>'input-lg']) !!}
                                </div>
                                <div class="form-group col-sm-12">
                                    <label>Prioridad:</label><br/>
                                    <input type="number" name="priority" min='0' max='5' />
                                </div>
                                 <div class="form-group col-sm-12">
                                    <label>Estado:</label><br/>
                                    {!! Form::select('status', array('1' => 'Habilitado', '0' => 'Deshabilitado'),null,['class'=>'input-lg']) !!}
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="pull-right btn-group">
                                    <button type="button" onclick="window.location='{!! URL::to('backend/events/') !!}'" class="btn btn-danger">Cancelar</button>
                                    {!! Form::submit('Guardar',['class'=>'btn btn-success']) !!}
                                </div>
                            </div>
                        {!! Form::close() !!}
                        <div class="clearfix"></div>
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

        previewFile();  //calls the function named previewFile()
        </script>

    @endsection