@extends('admin.layouts.layout')
@section('header')

    <section class="content-header">
      <h1>
        Editar un alumno
        <small>A continuacion podra editar la informacion de un alumno</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li>Alumno</li>
        <li class="active">Editar</li>
      </ol>
    </section>

@endsection

@section('content')
  <div class="row">
    {!!Form::model($student, array('route' => array('admin.students.update', $student)))!!}
    @csrf {{method_field('PUT')}}
        
       <div class="col-md-8">
        <div class="box">
          <div class="box-body">
              <div class="form-group {{$errors->has('name') ? 'has-error' : ''}}" >
              	{!!Form::label('name', 'Nombre del alumno')!!}
                {!!Form::text('name', old('name') ,['placeholder' => 'Escriba el nombre del alumno' , 'class' => 'form-control'])!!}
                {!! $errors->first('name', '<span class="help-block">:message</span>')!!}     
              </div>

              <div class="form-group {{$errors->has('surnames') ? 'has-error' : ''}}" >
              	{!!Form::label('surnames', 'Apellidos de alumno')!!}
                {!!Form::text('surnames', old('surnames') ,['placeholder' => 'Escriba los apellidos del alumno' , 'class' => 'form-control'])!!}
                {!! $errors->first('surnames', '<span class="help-block">:message</span>')!!}     
              </div>

              <div class="form-group {{$errors->has('phone') ? 'has-error' : ''}}" >
              	{!!Form::label('phone', 'Telefono del alumno')!!}
                {!!Form::number('phone', old('phone') ,['placeholder' => 'Escriba el telefono de alumno' , 'class' => 'form-control'])!!}
                {!! $errors->first('phone', '<span class="help-block">:message</span>')!!}     
              </div>

              <div class="form-group {{$errors->has('address') ? 'has-error' : ''}}" >
              	{!!Form::label('address', 'Direccion del alumno')!!}
                {!!Form::text('address', old('address') ,['placeholder' => 'Escriba la direccion del alumno' , 'class' => 'form-control'])!!}
                {!! $errors->first('address', '<span class="help-block">:message</span>')!!}     
              </div>
              
              <div class="form-group {{$errors->has('dni') ? 'has-error' : ''}}" >
              	{!!Form::label('dni', 'Dni del alumno')!!}
                {!!Form::text('dni', old('dni') ,['placeholder' => 'Escriba el dni del alumno' , 'class' => 'form-control'])!!}
                {!! $errors->first('dni', '<span class="help-block">:message</span>')!!}     
              </div>


          </div>
        </div>
      </div>
        
        <div class="col-md-4">
        <div class="box">
          <div class="box-body">
              
				<div class="form-group {{ $errors->has('subject_id') ? 'has-error' : '' }}">

                  {!! Form::label('subject_id' , 'Agregar una asignatura') !!}

                  {!! Form::select('subject_id[]',$subjects, $student->subjects->pluck('id'), ['id' => 'curso','class'=>'form-control' , 'multiple' => true]) !!}

                  <span class="text-danger">{{ $errors->first('subject_id') }}</span>

                </div>
              
              <div class="form-group {{$errors->has('email') ? 'has-error' : ''}}" >
              	{!!Form::label('email', 'Email del alumno')!!}
                {!!Form::text('email', old('email') ,['placeholder' => 'Escriba el email del alumno' , 'class' => 'form-control'])!!}
                {!! $errors->first('email', '<span class="help-block">:message</span>')!!}     
              </div>
              
              <div class="form-group {{$errors->has('password') ? 'has-error' : ''}}" >
              	{!!Form::label('password', 'Password del alumno')!!}
              	<br>
                {!!Form::password('password', old('password') ,['placeholder' => 'Password' , 'class' => 'form-control'])!!}
                {!! $errors->first('password', '<span class="help-block">:message</span>')!!}     
              </div>

              <div class="form-group">
                <label></label>
                  <button type="submit" class="btn btn-primary btn-block">Registrar un alumno</button>
              </div>

          </div>
        </div>
      </div>
    {!! Form::close() !!}
  </div>

@endsection