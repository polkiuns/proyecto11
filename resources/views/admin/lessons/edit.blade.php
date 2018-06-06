@extends('admin.layouts.layout')
@section('header')

    <section class="content-header">
      <h1>
        Editar una leccion
        <small>A continuacion podra editar una leccion</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li>Lecciones</li>
        <li class="active">Editar</li>
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
              <label class="form-control">Lista de lecciones de {{$categories->first()->subject->name}}</label>

                <ul id="tree1">

                    @foreach($categories as $category)

                        <li>

                            <a id="" href="#">{{ $category->name }}</a>

                            @if(count($category->childs))

                                @include('manageChild',['childs' => $category->childs])

                            @endif
                        </li>

                    @endforeach

                </ul>
            </div>
            </div>
            </div>
            </div>

            <div class="col-md-6">
            <div class="box">
                        <div class="box-body">
              
              <label class="form-control">Editar una leccion</label>


              {!!Form::model($lesson, array('route' => array('admin.lessons.update', $lesson)))!!}
                @csrf {{method_field('PUT')}}
                  <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">

                  {!! Form::label('name' , 'Nombre de la leccion') !!}

                  {!! Form::text('name', $lesson->name, ['id' => 'name' ,'class'=>'form-control', 'placeholder'=>'Enter name']) !!}

                  <span class="text-danger">{{ $errors->first('name') }}</span>

                </div>


                <div class="form-group {{ $errors->has('subject_id') ? 'has-error' : '' }}">

                  {!! Form::label('subject_id' , 'Agregar una asignatura') !!}

                  {!! Form::select('subject_id',$subjects, $lesson->subject->id, ['id' => 'curso','class'=>'form-control']) !!}

                  <span class="text-danger">{{ $errors->first('subject_id') }}</span>

                </div>

                <div class="form-group {{ $errors->has('lesson_id') ? 'has-error' : '' }}">

                  {!! Form::label('lesson_id' , 'Agregar Subleccion si se desea') !!}

                  <select id="lesson" name="lesson_id" disabled="true" class="form-control">
                    <option value="0">No pertenecer a una leccion</option>
                  </select>

                  <span class="text-danger">{{ $errors->first('lesson_id') }}</span>

                </div>

              <div class="checkbox">
                <label>
                  <input type="checkbox" name="published">Publicar
                </label>
              </div>
                <div class="form-group">

                  <button class="btn btn-success">Editar leccion</button>

                </div>


                {!! Form::close() !!}
              </div>
            </div>





@endsection

@push('script')
<script type="text/javascript">


  $("#tree1 li>a").click(function(){
    $("#curso option").attr("selected" , false);
    var texto = $(this).text();
    $("#curso option").each(function(index) {
        if(texto == $("#curso option:eq("+index+")").text()){
          $("#curso option:eq("+index+")").attr("selected" , true);
        }
    });

  });
</script>
@endpush