@extends('admin.layouts.layout')

@section('header')

    <section class="content-header">
      <h1>
        Todos los profesores
        <small>A continuacion se mostrara el panel de adm de profesores</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Profesores</li>
      </ol>
    </section>

@endsection


@section('content')



            
            <div class="box">
              <div class="box-header">
                <h3 class="box-title">Listado de profesores</h3>
              </div>

            <div class="box-body">
              <table id="cursos-table" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Nombre</th>
                  <th>Apellidos</th>
                  <th>Asignaturas</th>
                  <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                  
					@foreach($teachers as $teacher)
                    <tr>
                      <td>{{$teacher->id}}</td>
                      <td>{{$teacher->name}}</td>
                      <td>{{$teacher->surnames}}</td>
                      <td>
                      	  @foreach($teacher->subjects as $subject)
                            | {{$subject->name}} |
                          @endforeach
                      </td>
                      <td>
                          
                          <a href="{{route('admin.teachers.edit' , $teacher)}}" title="Editar curso" class="btn btn-xs btn-info"><i class="fa fa-pencil"></i></a>
                         
                          <form method = "POST" action ="{{route('admin.teachers.delete' , $teacher)}}" style="display: inline;">
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