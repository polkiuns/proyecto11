@extends('admin.layouts.layout')
@section('header')

    <section class="content-header">
      <h1>
        Crear una nueva leccion
        <small>A continuacion podra crear una nueva leccion</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li>Leccion</li>
        <li class="active">Crear</li>
      </ol>
    </section>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script type="text/javascript" src="/js/lecciones.js"></script>
@endsection

@section('content')


          
          <div class="row">

            <div class="col-md-6">
      
            <div class="box">
            <div class="box-body">
              <div class="form-group">
              <label class="form-control">Lista de lecciones de la asignatura(Experimental)</label>


            </div>
            </div>
            </div>
            </div>

            <div class="col-md-6">
            <div class="box">
                        <div class="box-body">
              
              <label class="form-control">Crear una nueva leccion</label>


                {!! Form::open(['route'=>'admin.lessons.store']) !!}

                  <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">

                  {!! Form::label('name' , 'Nombre de la leccion') !!}

                  {!! Form::text('name', old('name'), ['id' => 'name' ,'class'=>'form-control', 'placeholder'=>'Enter name']) !!}

                  <span class="text-danger">{{ $errors->first('name') }}</span>

                </div>


                <div class="form-group {{ $errors->has('subject_id') ? 'has-error' : '' }}">

                  {!! Form::label('subject_id' , 'Agregar asignatura de la leccion') !!}

                  {!! Form::select('subject_id',$subjects, old('subject_id'), ['id' => 'curso','class'=>'form-control']) !!}

                  <span class="text-danger">{{ $errors->first('subject_id') }}</span>

                </div>

                <div class="form-group {{ $errors->has('lesson_id') ? 'has-error' : '' }}">

                  {!! Form::label('lesson_id' , 'Agregar Subleccion si se desea') !!}

                  <select id="lesson" name="lesson_id" disabled="true" class="form-control">
                    <option value=null>No pertenecer a una leccion</option>
                  </select>

                  <span class="text-danger">{{ $errors->first('lesson_id') }}</span>

                </div>
              
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="published">Publicar
                </label>
              </div>

                <div class="form-group">

                  <button class="btn btn-success">Crear leccion</button>

                </div>


                {!! Form::close() !!}
              </div>
            </div>





@endsection

@push('script')


@endpush