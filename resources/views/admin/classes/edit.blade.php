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
<script type="text/javascript" src="/js/lecciones2.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.css">
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/min/dropzone.min.js"></script>
<script>
  $(function () {
    CKEDITOR.replace('editor1');


  });
</script>

@endsection

@section('content')
            
  <div class="row">
    @if($class->files->count())
      <div class="col-md-12">
        <small>(pulsar nombre para descargar archivo)</small>
        <div class="box box-primary">
          <div class="box-body">
              @foreach($class->files as $file)
                <form method="POST" action="{{route('admin.file.delete' , $file)}}">
                  {{method_field('DELETE')}} @csrf
                    <div class="col-md-2">
                      <button class="btn btn-danger btn-xs" style="position: absolute">
                        <i class="fa fa-remove"></i>
                      </button>
                      <img src="https://lh3.ggpht.com/hXwdHw8jKna3Ox864_sDUxkGo40b7GGq-y-uGHcb5KeCiN_eRQh_WPXmoSCOoD9KKw=s128" alt="" class="img-responsive">
                      <p><a style="color:green;" href="{{route('admin.file.download', $file)}}">{{$file->name}}</a></p>
                    </div>  
                </form>
              @endforeach
          </div>
        </div>
      </div>
    @endif



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
              
        <div class="form-group {{ $errors->has('subject_id') ? 'has-error' : '' }}">

                  {!! Form::label('subject_id' , 'Agregar una categoria') !!}

                  {!! Form::select('subject_id',$subjects, $class->lesson->subject->id, ['id' => 'curso','class'=>'form-control']) !!}

                  <span class="text-danger">{{ $errors->first('subject_id') }}</span>

                </div>

        <div class="form-group {{ $errors->has('lesson_id') ? 'has-error' : '' }}">

                  {!! Form::label('lesson_id' , 'Agregar una categoria') !!}

                  <select id="lesson" name="lesson_id" disabled="true" class="form-control">
                    <option value="0">Selecciona un tema para la clase</option>
                  </select>

                  <span class="text-danger">{{ $errors->first('lesson_id') }}</span>

                </div>
                        
                        <div class="form-group">
                          <div class="dropzone" id="dropzone1">
                          </div>
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
                  <button type="submit" class="btn btn-primary btn-block" id="enviar">Crear clase</button>
              </div>

          </div>
        </div>
      </div>
    {!! Form::close() !!}
    {{$class->id}}
  </div>

<script>
Dropzone.autoDiscover = false;
var myDropzone = new Dropzone('.dropzone' , {
  url: "/admin/file/edit/{{($idClase=$class->id)}}",
  paramName: 'file',
  autoProcessQueue: false,
  maxFileSize: 2,
  headers: {
    'X-CSRF-TOKEN' : '{{csrf_token()}}'
  },

  dictDefaultMessage: "Sube cualquier archivo a tu clase"
});
 myDropzone.on('error' ,function(file, res) {
  $('.dz-error-message:last span').text(res.errors.foto[0])
 });
  $('#enviar').click(function(){
      myDropzone.processQueue()
  });
</script>
@endsection