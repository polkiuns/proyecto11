@extends('admin.layouts.layout')

@section('header')

    <section class="content-header">
      <h1>
        Todas las clases
        <small>A continuacion se mostraran las clases disponibles</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Clases</li>
      </ol>
    </section>

@endsection


@section('content')



            
            <div class="box">
              <div class="box-header">
                <h3 class="box-title">Listado de clases</h3>
              </div>

            <div class="box-body">
              <table id="cursos-table" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Nombre</th>
                  <th>Descripcion</th>
                  <th>Leccion</th>
                  <th>¿Publicado?</th>
                  <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                  
					@foreach($classes as $class)
                    <tr>
                      <td>{{$class->id}}</td>
                      <td>{{$class->name}}</td>
                      <td>{{$class->description}}</td>
                      <td>{{$class->lesson->name}}</td>
                      <td>{{$class->published == 1 ? "Si" : "No"}}</td>
                      <td>
                          <a href="{{route('admin.classes.deliveries' , $class)}}" title="Editar curso" class="btn btn-xs btn-success"><i class="fa fa-angle-double-right"></i></a>
                         
                          <a href="{{route('admin.classes.edit' , $class)}}" title="Editar curso" class="btn btn-xs btn-info"><i class="fa fa-pencil"></i></a>
                         
                          <form method = "POST" action ="{{route('admin.classes.delete' , $class)}}" style="display: inline;">
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