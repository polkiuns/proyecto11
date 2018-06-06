@extends('admin.layouts.layout')

@section('header')

    <section class="content-header">
      <h1>
        Todos los alumnos
        <small>A continuacion se muestran todos los alumnos de la academia</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Alumnos</li>
      </ol>
    </section>

@endsection


@section('content')

            <div class="box">
              <div class="box-header">
                <h3 class="box-title">Listado de todos los alumnos</h3>
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
          @if(isset($students))
					@foreach($students as $student)
                    <tr>
                      <td>{{$student->id}}</td>
                      <td>{{$student->name}}</td>
                      <td>
                        @foreach($student->subjects as $subject)
                        | {{$subject->name}} |
                        @endforeach
                      </td>
                      <td>                       
                          <a href="{{route('admin.students.edit' , $student)}}" title="Editar curso" class="btn btn-xs btn-info"><i class="fa fa-pencil"></i></a>
                         @if(auth()->user()->hasRole('root'))
                          <form method = "POST" action ="{{route('admin.students.delete' , $student)}}" style="display: inline;">
                          @csrf {{method_field('DELETE')}} 
                          <button onclick = "return confirm('¿Estas seguro de querer borrar este curso?')" title="Eliminar curso" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></button>
                          
                          </form>
                          @endif
                      </td>
                    </tr>
					@endforeach
          @else
                    @foreach($subjects as $subject)
                    @foreach($subject->students as $student)
                    <tr>
                      <td>{{$student->id}}</td>
                      <td>{{$student->name}}</td>
                      <td>
                        @foreach($student->subjects as $subject)
                        | {{$subject->name}} |
                        @endforeach
                      </td>
                      <td>                       
                          <a href="{{route('admin.students.edit' , $student)}}" title="Editar curso" class="btn btn-xs btn-info"><i class="fa fa-pencil"></i></a>
                         
                          <form method = "POST" action ="{{route('admin.students.delete' , $student)}}" style="display: inline;">
                          @csrf {{method_field('DELETE')}} 
                          <button onclick = "return confirm('¿Estas seguro de querer borrar este curso?')" title="Eliminar curso" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></button>
                          
                          </form>
                      </td>
                    </tr>
          @endforeach
          @endforeach
          @endif
                </tbody>
              </table>
            </div>
          </div>

@endsection