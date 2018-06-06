@extends('admin.layouts.layout')

@section('header')

    <section class="content-header">
      <h1>
        Todos los cursos
        <small>A continuacion se mostraran todos los cursos disponibles</small>
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
                  <th>Pertenece a</th>
                  <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                  
					@foreach($courses as $course)
                    <tr>
                      <td>{{$course->id}}</td>
                      <td>{{$course->name}}</td>
                      <td>{{isset($course->parent) ? $course->parent->name : 'Es la categoria padre'}}</td>
                      <td>
                          
                          <a href="{{route('admin.courses.edit' , $course)}}" title="Editar curso" class="btn btn-xs btn-info"><i class="fa fa-pencil"></i></a>
                         @if(!count($course->childs))
                          <form method = "POST" action ="{{route('admin.courses.delete' , $course)}}" style="display: inline;">
                          @csrf {{method_field('DELETE')}} 
                          <button onclick = "return confirm('¿Estas seguro de querer borrar este curso?')" title="Eliminar curso" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></button>
                          
                          </form>
                          @endif
                      </td>
                    </tr>
					@endforeach       
                </tbody>
              </table>
            </div>
          </div>

@endsection