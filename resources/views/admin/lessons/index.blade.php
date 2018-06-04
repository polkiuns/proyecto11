@extends('admin.layouts.layout')

@section('header')

    <section class="content-header">
      <h1>
        Todas las lecciones
        <small>A continuacion se mostraran todas las lecciones</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Cursos</li>
      </ol>
    </section>

@endsection


@section('content')

            <div class="box">
              <div class="box-header">
                <h3 class="box-title">Listado de cursos</h3>
              </div>

            <div class="box-body">
              <table id="cursos-table" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Nombre</th>
                  <th>Asignatura</th>
                  <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                  
					@foreach($lessons as $lesson)
                    <tr>
                      <td>{{$lesson->id}}</td>
                      <td>{{$lesson->name}}</td>
                      <td>{{$lesson->subject->name}}</td>
                      <td>                       
                          <a href="{{route('admin.lessons.edit' , $lesson)}}" title="Editar curso" class="btn btn-xs btn-info"><i class="fa fa-pencil"></i></a>
                         
                          <form method = "POST" action ="{{route('admin.lessons.delete' , $lesson)}}" style="display: inline;">
                          @csrf {{method_field('DELETE')}} 
                          <button onclick = "return confirm('¿Estas seguro de querer borrar este curso?')" title="Eliminar curso" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></button>
                          
                          </form>
                      </td>
                    </tr>
					@endforeach       
                </tbody>
              </table>
            </div>
          </div>

@endsection