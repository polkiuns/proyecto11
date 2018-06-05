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
                  <th>Curso</th>
                  <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                  
					@foreach($subjects as $subject)
                    <tr>
                      <td>{{$subject->id}}</td>
                      <td>{{$subject->name}}</td>
                      <td>
                          @foreach($subject->courses as $course)
                            | {{$course->name}} |
                          @endforeach
                      </td>
                      @if(auth()->user()->hasRole('root'))
                      <td>                          
                          <a href="{{route('admin.subjects.edit' , $subject)}}" title="Editar curso" class="btn btn-xs btn-info"><i class="fa fa-pencil"></i></a>
                         
                          <form method = "POST" action ="{{route('admin.subjects.delete' , $subject)}}" style="display: inline;">
                          @csrf {{method_field('DELETE')}} 
                          <button onclick = "return confirm('¿Estas seguro de querer borrar este curso?')" title="Eliminar curso" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></button>
                          
                          </form>
                      </td>
                      @else 
                      <td>No estas autorizado para realizar ninguna accion aqui</td>
                      @endif
                    </tr>
					@endforeach       
                </tbody>
              </table>
            </div>
          </div>

@endsection

