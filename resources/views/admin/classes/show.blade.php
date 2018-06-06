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
                  <th>Nombre alumno</th>
                  <th>Asignatura</th>
                  <th>Clase correspondiente</th>
                  <th>Leccion</th>
                  <th>Nota</th>
                  <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                  
					@foreach($deliveries as $delivery)
                    <tr>
                      <td>{{$delivery->id}}</td>
                      <td>{{$delivery->user->name}}</td>
                      <td>{{$delivery->clase->lesson->subject->name}}</td>
                      <td>{{$delivery->clase->name}}</td>
                      <td>{{$delivery->clase->lesson->name}}</td>
                      @if(isset($delivery->nota))
                      <td>{{$delivery->nota}}</td>
                      @else
                      <td><strong style="color: red;">No tiene nota todavia</strong></td>
                      @endif
                      <td>
                          <a href="{{route('admin.deliveries.download' , $delivery)}}" title="Editar curso" class="btn btn-xs btn-success"><i class="fa fa-angle-double-down"></i></a>
                         
                          <button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#myModal"><i class="fa fa-pencil"></i></button>
                         
                          <form method = "POST" action ="{{route('admin.deliveries.delete' , $delivery)}}" style="display: inline;">
                          @csrf {{method_field('DELETE')}} 
                          <button onclick = "return confirm('¿Estas seguro de querer borrar este curso?')" title="Eliminar curso" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></button>
                          
                          </form>
                      </td>
                    </tr>
					
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	{!! Form::open(array('route' => array('admin.deliveries.grades', $delivery))) !!}
    @csrf {{method_field('PUT')}}
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Nota de la entrega</h4>
      </div>
      <div class="modal-body">
                {!!Form::number('nota', old('nota') ,['placeholder' => 'Escriba la nota del alumno' , 'class' => 'form-control'])!!}
                {!! $errors->first('nota', '<span class="help-block">:message</span>')!!} 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button class="btn btn-primary">Agregar nota</button>
      </div>
    </div>
  </div>
   {!! Form::close() !!}
</div>


					@endforeach       
                </tbody>
              </table>
            </div>
          </div>


<!-- Modal -->



@endsection