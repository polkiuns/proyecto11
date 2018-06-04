@extends('admin.layouts.layout')

@section('header')

    <section class="content-header">
      <h1>
        Todas las suscripciones
        <small>A continuacion vera una lista de todas las suscripciones</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">suscripciones</li>
      </ol>
    </section>

@endsection


@section('content')

            <div class="box">
              <div class="box-header">
                <h3 class="box-title">Listado de subcripciones</h3>
              </div>

            <div class="box-body">
              <table id="cursos-table" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Nombre alumno</th>
                  <th>Asignatura a suscribir</th>
                  @if(auth()->user()->hasRole('root'))
                  <th>Nombre profesor</th>
                  @endif
                  <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                  
					@foreach($subcriptions as $subcription)
                    <tr>
                      <td>{{$subcription->id}}</td>
                      <td>{{$subcription->student->name}}</td>
                      <td>{{$subcription->subject->name}}</td>
                      @if(auth()->user()->hasRole('root'))
                      <td>{{$subcription->teacher->name}}</td>
                      @endif
                      <td>
                          
                          <a href="{{route('admin.subcription.accept' , $subcription)}}" title="Aceptar subcripcion" class="btn btn-xs btn-info"><i class="fa fa-pencil"></i></a>
                         
                          <a href="{{route('admin.subcription.denegate' , $subcription)}}" title="Denegar subcripcion" class="btn btn-xs btn-danger"><i class="fa fa-pencil"></i></a>
                          
                      </td>
                    </tr>
					@endforeach       
                </tbody>
              </table>
            </div>
          </div>

@endsection