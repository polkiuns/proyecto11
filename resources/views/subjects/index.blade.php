@extends('layouts.app')
@section('content')
	<br><br><br>
    <main role="main" class="container">
      <div class="row">
        <div class="col-md-8 blog-main">
          <a class="btn btn-outline-primary" href="javascript:history.go(-1)">Atras</a>
          <br/><br/>
          <h3 class="pb-3 mb-4 font-italic border-bottom">
            Curso de: {{$subject->name}}
          </h3>

          <div class="blog-post">
            <p>{{$subject->description}}</p>
      <br>
      <h5 class="pb-3 mb-4 font-italic border-bottom" id="lecciones"> Lecciones </h3>
		
		@auth
            @if(auth()->user()->hasRole('root') || auth()->user()->hasRole('teacher') || auth()->user()->student->subjects->prepend(0)->pluck('id')->search($subject->id))
			         @foreach($subject->lessons->where('lesson_id' , null) as $lesson)
                  @if($lesson->published != 0)
                  <div class="card-deck mb-3 text-center">
                  <div class="card mb-4 box-shadow">
                  <div class="card-header">
                  <h4 class="my-0 font-weight-normal">{{$lesson->name}}</h4>
                  </div>
                  <div class="card-body">
                  <ul class="list-unstyled mt-3 mb-4">
			           
                  @if(count($lesson->clases))
                    @foreach($lesson->clases as $clase)  
                        <li><a href="{{route('classes.index' , array($subject , $clase))}}">{{$clase->name}}</a></li>
			               @endforeach
                  @else
                        <li><p>Contenido no disponible</p></li>
                  @endif
                  @if(count($lesson->childs))
                  @foreach($lesson->childs as $child)
                  

                  <div class="card-deck mb-3 text-center">
                  <div class="card mb-4 box-shadow">
                  <div class="card-header">
                  <h4 class="my-0 font-weight-normal">{{$child->name}}</h4>
                  </div>
                  <div class="card-body">
                  <ul class="list-unstyled mt-3 mb-4">
                  @if(count($child->clases))
                    @foreach($child->clases as $clase)  
                        <li><a href="{{route('classes.index' , array($subject , $clase))}}">{{$clase->name}}</a></li>
                     @endforeach
                  @else
                        <li><p>Contenido no disponible</p></li>
                  @endif                      
                      @include('manageLesson',['childs' => $child->childs , 'subject' => $subject])
                     
                      </ul>
                       </div>
                       </div>
                      </div>
                  
                  @endforeach
                  @endif
                        </ul>
                       </div>
                       </div>
                             </div>
			         @endif
               @endforeach
      
            @else
            <div class="alert alert-danger">
              <strong>Suscribete al curso para poder acceder a las lecciones</strong>
            </div> 
            @endif
		@endauth

		@guest
		<div class="alert alert-danger">
  			<strong>Necesitas estar logueado para ver esta seccion</strong>
		</div>
		@endguest

          </div><!-- /.blog-post -->
      <br>
          <nav class="blog-pagination">
            <a class="btn btn-outline-primary" href="#lecciones">Arriba</a>
          </nav>

        </div><!-- /.blog-main -->

        <aside class="col-md-4 blog-sidebar">
          <div class="p-3 mb-3 bg-light rounded">
          @guest
            <div class="alert alert-danger">
              <strong>Para poder suscribirte necesitas estar logueado</strong>
            </div>          
          @endguest
          @auth

              @if(auth()->user()->hasRole('teacher') || auth()->user()->hasRole('root') || auth()->user()->student->subjects->pluck('id')->search($subject->id))
                
                <strong style="color:red;">Ya posees este curso</strong>
             
              @elseif(auth()->user()->student->subcriptions->pluck('subject_id')->prepend(0)->search($subject->id))
                <strong style="color:green">Se esta procesando tu entrada al curso</strong>
              @else
          
          {!! Form::open(['route' => array('subcription.create', $subject)]) !!}
          @csrf 
        
            <button onclick = "return confirm('¿Estas seguro de querer subscribirte a este curso?')" title="subscribirte" class="btn btn-xs btn-danger">Suscribirse</button>
          
          {!! Form::close() !!}
          @endif
          @endauth
          </div>

          <div class="p-3">
            <h4 class="font-italic">Profesores</h4>
            <ol class="list-unstyled mb-0">
           	@foreach($subject->teachers as $teacher)
              <li><a href="#">{{$teacher->name}}</a></li>
            @endforeach
            </ol>
          </div>

        </aside><!-- /.blog-sidebar -->

      </div><!-- /.row -->

    </main><!-- /.container -->

@endsection

