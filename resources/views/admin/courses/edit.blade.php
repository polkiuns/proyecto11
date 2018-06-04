@extends('admin.layouts.layout')
@section('header')

    <section class="content-header">
      <h1>
        Crear curso
        <small>A continuacion podra crear un curso</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li>Cursos</li>
        <li class="active">Crear</li>
      </ol>
    </section>



@endsection

@section('content')



          <div class="row">

            <div class="col-md-6">
      
            <div class="box">
            <div class="box-body">
              <div class="form-group">
              <label class="form-control">Lista de cursos</label>

                <ul id="tree1">

                    @foreach($categories as $category)

                        <li>

                            <a id="" href="#">{{ $category->name }}</a>

                            @if(count($category->childs))

                                @include('manageChild',['childs' => $category->childs , 'noSubject' => true])

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
              
              <label class="form-control">Editar un curso nuevo</label>


              {!!Form::model($course, array('route' => array('admin.courses.update', $course)))!!}
                @csrf {{method_field('PUT')}}
                  <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">

                  {!! Form::label('name' , 'Nombre del curso') !!}

                  {!! Form::text('name', $course->name, ['id' => 'name' ,'class'=>'form-control', 'placeholder'=>'Enter name']) !!}

                  <span class="text-danger">{{ $errors->first('name') }}</span>

                </div>


                <div class="form-group {{ $errors->has('courses_id') ? 'has-error' : '' }}">

                  {!! Form::label('courses_id' , 'Agregar una categoria') !!}

                  {!! Form::select('courses_id',$allCategories, $course->course_id, ['id' => 'curso','class'=>'form-control' , 'placeholder' => 'Categoria padre']) !!}

                  <span class="text-danger">{{ $errors->first('courses_id') }}</span>

                </div>


                <div class="form-group">

                  <button class="btn btn-success">Editar curso</button>

                </div>


                {!! Form::close() !!}
              </div>
            </div>




<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
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
@endsection
