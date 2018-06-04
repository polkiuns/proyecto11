@extends('admin.layouts.layout')
@section('header')

    <section class="content-header">
      <h1>
        Crear curso
        <small>A continuacion podra crear un curso</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li>Cursos</li>
        <li class="active">Crear</li>
      </ol>
    </section>
<script type="text/javascript" src="/js/jquery-3.1.1.min.js"></script>
<script src="/adminlte/bower_components/ckeditor/ckeditor.js"></script>

<script>
  $(function () {
    CKEDITOR.replace('editor1');
    $('.textarea').wysihtml5();

  });
</script>

@endsection

@section('content')
            
  <div class="row">
    {!! Form::model($class, array('route' => array('admin.classes.update', $class))) !!}
    @csrf {{method_field('PUT')}}
        
       <div class="col-md-8">
        <div class="box">
          <div class="box-body">
              <div class="form-group {{$errors->has('name') ? 'has-error' : ''}}" >
              	{!!Form::label('name', 'Nombre del curso')!!}
                {!!Form::text('name', old('name') ,['placeholder' => 'Escriba el nombre del curso' , 'class' => 'form-control'])!!}
                {!! $errors->first('name', '<span class="help-block">:message</span>')!!}     
              </div>
              <div class="form-group {{$errors->has('description') ? 'has-error' : ''}}">
              	{!!Form::label('description', 'Descripcion del curso')!!}
                {!!Form::textarea('description', old('description'),['placeholder' => 'Escriba la description del curso' , 'class' => 'form-control' , 'size' => '5x3'])!!}
                {!! $errors->first('description', '<span class="help-block">:message</span>') !!}
              </div>
              <div class="form-group {{$errors->has('iframe') ? 'has-error' : ''}}">
                {!!Form::label('iframe', 'Iframe (Video curso)')!!}
                {!!Form::textarea('iframe', old('iframe') ,['placeholder' => 'Ingresa contenido audiovisual' , 'class' => 'form-control' , 'size' => '5x2'])!!}         
                {!! $errors->first('iframe', '<span class="help-block">:message</span>') !!}
              </div>
              <div class="form-group {{$errors->has('body') ? 'has-error' : ''}}">
              	{!!Form::label('body', 'Contenido del curso')!!}
               	{!!Form::textarea('body', old('body'),['placeholder' => 'Ingresa contenido body' , 'class' => 'form-control' , 'size' => '5x10' , 'id' => 'editor1'])!!}					
                {!! $errors->first('body', '<span class="help-block">:message</span>') !!}
              </div>
          </div>
        </div>
      </div>
        
        <div class="col-md-4">
        <div class="box">
          <div class="box-body">
              
				<div class="form-group {{ $errors->has('lesson_id') ? 'has-error' : '' }}">

                  {!! Form::label('lesson_id' , 'Agregar una categoria') !!}

                  {!! Form::select('lesson_id',$lessons, old('lesson_id'), ['id' => 'curso','class'=>'form-control']) !!}

                  <span class="text-danger">{{ $errors->first('lesson_id') }}</span>

                </div>

              <div class="checkbox">
                <label>
                  <input type="checkbox" name="published">Publicar
                </label>
                <label>
                  <input type="checkbox" name="allowDelivery">Permitir entrega
                </label>
              </div>
              <div class="form-group">
                <label></label>
                  <button type="submit" class="btn btn-primary btn-block">Crear clase</button>
              </div>

          </div>
        </div>
      </div>
    {!! Form::close() !!}
  </div>


@endsection