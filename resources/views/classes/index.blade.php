@extends('layouts.app')
@section('content')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.css">
<script type="text/javascript" src="/js/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/min/dropzone.min.js"></script>
<script type="text/javascript">
  $(function(){
    $("textarea[name='bodyEditar']").hide();
    $("button[name='enviarEditar']").hide();

    $("a[name='comentarioEditar']").click(function(){
    enlace = $(this);
    if(enlace.html() == "Ocultar") {
      caja.hide();
      boton.hide();
      enlace.html('Editar');
    } else {
    $("textarea[name='bodyEditar']").hide();
    $('textarea[name="bodyEditar"]').each(function(idx, el) {
    if($(el).attr('id') == enlace.attr('href')) {
      $(el).show();
      caja = $(el);
      enlace.html('Ocultar');
      boton = $(el).next().show();
    }
        });      
    }

    });
});
</script>
@auth
@if(auth()->user()->hasRole('teacher') || auth()->user()->hasRole('root'))
  


  <br><br><br>
    <main role="main" class="container">
      <div class="row">
        <div class="col-md-8 blog-main">
          <h3 class="pb-3 mb-4 font-italic border-bottom">
          <a class="btn btn-outline-primary" href="javascript:history.go(-1)">Atrasdfsdfs</a>
          <br/><br/>
            {{$clase->name}}
          </h3>

          <div class="blog-post">

        @if($clase->iframe)
          {!!$clase->iframe!!}
        @endif
            <h3>Contenido de la clasedfg</h3>
      <h3 class="pb-3 mb-4 font-italic border-bottom"></h3>
      {!!$clase->body!!}
      <br>
      <br>


                  <h3>Comentarios</h3>
      <h3 class="pb-3 mb-4 font-italic border-bottom"></h3>

            @if(count($clase->comments))

      
<table>
  @foreach($clase->comments as $comment)
       <tr>
           <td>
               <hr><p><code><em>{{$comment->body}}</em></code></p>
               <p><center><img src=https://i.imgur.com/d1I1Hew.png>
               <strong><code>{{$comment->user->name}}</code></strong>
               <img src=https://i.imgur.com/GY2GNpC.png></center></p><hr>
           </td>
       </tr>
                     @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('teacher') || (auth()->user()->id == $comment->user->id))
       <tr>
            <td>

              <form method = "POST" action ="{{route('classes.comments.delete' , $comment)}}" style="display: inline;">
                @csrf {{method_field('DELETE')}} 
              <button onclick = "return confirm('¿Estas seguro de querer borrar este curso?')" title="Eliminar curso" class="btn btn-xs ">Eliminar</button>
              </form>&nbsp;
            <a href="{{'#cajaEditar'.$loop->iteration}}" name="comentarioEditar">Editar</a> &nbsp;
           </td>
       </tr>
       <tr>
        <td>
          {!! Form::open(array('route' => array('classes.comments.edit', $comment))) !!}
              @csrf {{method_field('PUT')}}
              <div class="form-group {{$errors->has('bodyEditar') ? 'has-error' : ''}}">
                {!!Form::textarea('bodyEditar', $comment->body ,['placeholder' => 'Ingresa tu comentario' , 'class' => 'form-control' , 'size' => '5x2' , 'id' => '#cajaEditar'.$loop->iteration])!!}  
                <button type="submit" class="btn btn-outline-success float-right" name="enviarEditar">Enviar</button>       
                {!! $errors->first('bodyEditar', '<span class="help-block">:message</span>') !!}
              </div>
          
          {!! Form::close() !!}
        </td>
       </tr>
      @endif
  @endforeach
</table>
      @endif
        <h3 class="pb-3 mb-4 font-italic border-bottom"></h3>
      <br>
          {!! Form::open(array('route' => array('classes.comments', $clase))) !!}
              @csrf
              <div class="form-group {{$errors->has('body') ? 'has-error' : ''}}">
                {!!Form::textarea('body', old('body') ,['placeholder' => 'Ingresa tu comentario' , 'class' => 'form-control' , 'size' => '5x2' , 'id' => 'cajaComentario'])!!}         
                {!! $errors->first('body', '<span class="help-block">:message</span>') !!}
              </div>
          </div><!-- /.blog-post -->

      <br>
          <nav class="blog-pagination">
            <button type="submit" class="btn btn-outline-success float-right" id="enviar">Enviar</button>
          </nav>
    {!! Form::close() !!}
        </div><!-- /.blog-main -->

        <aside class="col-md-4 blog-sidebar">
          <div class="p-3 mb-3 bg-light rounded">
            <h4 class="font-italic">Breve descripcion de la clase</h4>
            <p class="mb-0">{{$clase->description}}</p>
          </div>

          <div class="p-3">
            <h4 class="font-italic">Archives</h4>
            <ol class="list-unstyled mb-0">
            @if(count($clase->files))
              @foreach($clase->files as $file)
              <li><a href="{{route('clase.file.download' , $file)}}">{{$file->name}}</a></li>
              @endforeach
            @endif
            </ol>
          </div>
        </aside><!-- /.blog-sidebar -->

      </div><!-- /.row -->

    </main><!-- /.container -->


















@elseif(auth()->user()->student->subjects->prepend(0)->pluck('id')->search($subject->id))
  
  <br><br><br>
    <main role="main" class="container">
      <div class="row">
        <div class="col-md-8 blog-main">
          <h3 class="pb-3 mb-4 font-italic border-bottom">
          <a class="btn btn-outline-primary" href="javascript:history.go(-1)">Atras</a>
          <br/><br/>
            {{$clase->name}}
          </h3>

          <div class="blog-post">

        @if($clase->iframe)
          {!!$clase->iframe!!}
        @endif
            <h3>Contenido de la clasedfg</h3>
      <h3 class="pb-3 mb-4 font-italic border-bottom"></h3>
      {!!$clase->body!!}
      <br>
      <br>


                  <h3>Comentarios</h3>
      <h3 class="pb-3 mb-4 font-italic border-bottom"></h3>

            @if(count($clase->comments))

      
<table>
  @foreach($clase->comments as $comment)
       <tr>
           <td>
               <hr><p><code><em>{{$comment->body}}</em></code></p>
               <p><center><img src=https://i.imgur.com/d1I1Hew.png>
               <strong><code>{{$comment->user->name}}</code></strong>
               <img src=https://i.imgur.com/GY2GNpC.png></center></p><hr>
           </td>
       </tr>
                     @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('teacher') || (auth()->user()->id == $comment->user->id))
       <tr>
            <td>

              <form method = "POST" action ="{{route('classes.comments.delete' , $comment)}}" style="display: inline;">
                @csrf {{method_field('DELETE')}} 
              <button onclick = "return confirm('¿Estas seguro de querer borrar este curso?')" title="Eliminar curso" class="btn btn-xs ">Eliminar</button>
              </form>&nbsp;
            <a href="{{'#cajaEditar'.$loop->iteration}}" name="comentarioEditar">Editar</a> &nbsp;
           </td>
       </tr>
       <tr>
        <td>
          {!! Form::open(array('route' => array('classes.comments.edit', $comment))) !!}
              @csrf {{method_field('PUT')}}
              <div class="form-group {{$errors->has('bodyEditar') ? 'has-error' : ''}}">
                {!!Form::textarea('bodyEditar', $comment->body ,['placeholder' => 'Ingresa tu comentario' , 'class' => 'form-control' , 'size' => '5x2' , 'id' => '#cajaEditar'.$loop->iteration])!!}  
                <button type="submit" class="btn btn-outline-success float-right" name="enviarEditar">Enviar</button>       
                {!! $errors->first('bodyEditar', '<span class="help-block">:message</span>') !!}
              </div>
          
          {!! Form::close() !!}
        </td>
       </tr>
      @endif
  @endforeach
</table>
      @endif
        <h3 class="pb-3 mb-4 font-italic border-bottom"></h3>
      <br>
          {!! Form::open(array('route' => array('classes.comments', $clase))) !!}
              @csrf
              <div class="form-group {{$errors->has('body') ? 'has-error' : ''}}">
                {!!Form::textarea('body', old('body') ,['placeholder' => 'Ingresa tu comentario' , 'class' => 'form-control' , 'size' => '5x2' , 'id' => 'cajaComentario'])!!}         
                {!! $errors->first('body', '<span class="help-block">:message</span>') !!}
              </div>
          </div><!-- /.blog-post -->

      <br>
          <nav class="blog-pagination">
            <button type="submit" class="btn btn-outline-success float-right" id="enviar">Enviar</button>
          </nav>
    {!! Form::close() !!}
        </div><!-- /.blog-main -->

        <aside class="col-md-4 blog-sidebar">
          <div class="p-3 mb-3 bg-light rounded">
            <h4 class="font-italic">Breve descripcion de la clase</h4>
            <p class="mb-0">{{$clase->description}}</p>
          </div>

          <div class="p-3">
            <h4 class="font-italic">Archives</h4>
            <ol class="list-unstyled mb-0">
            @if(count($clase->files))
              @foreach($clase->files as $file)
              <li><a href="{{route('clase.file.download' , $file)}}">{{$file->name}}</a></li>
              @endforeach
            @endif
            </ol>
          </div>
          @if($clase->allowDelivery != 0)
          

          <div class="p-3">
            <h4 class="font-italic">Entregas</h4>
            <ol class="list-unstyled mb-0">
              @if($clase->deliveries->prepend(0)->pluck('user_id')->search(auth()->user()->id))
              
              <li>      
                
              @if(!$clase->deliveries->where('user_id' , auth()->user()->id)->pluck('nota')->first())
                <div class="alert alert-danger">
              <strong>Tienes una entrega activa, si subes una se eliminara la antigua</strong>
                </div>
              @else
                <div class="alert alert-danger">
              <strong>Tu entrega ha sido corregida y se han bloqueado los botones.</strong>
                </div>              
              @endif

                {{$clase->deliveries->where('user_id' , auth()->user()->id)->pluck('name')->first()}}
                <img src="https://lh3.ggpht.com/hXwdHw8jKna3Ox864_sDUxkGo40b7GGq-y-uGHcb5KeCiN_eRQh_WPXmoSCOoD9KKw=s128">
              @if(!$clase->deliveries->where('user_id' , auth()->user()->id)->pluck('nota')->first())
              <form method = "POST" action ="{{route('deliveries.delete' , $clase)}}" style="display: inline;">
              @csrf {{method_field('DELETE')}} 
                <button onclick = "return confirm('¿Estas seguro de querer borrar este curso?')" title="Eliminar entrega" class="btn btn-xs btn-danger">Dlt</button>
              </form>
                @endif

                <a href="{{route('deliveries.download' , $clase)}}" class="btn btn-success btn-xs">Dwnld</a>
                
              </li>
              
  
              @if($clase->deliveries->where('user_id' , auth()->user()->id)->pluck('nota')->first())
              <p>Tu nota es: {{$clase->deliveries->where('user_id' , auth()->user()->id)->pluck('nota')->first()}}</p>
              @else
              <p>No tiene nota</p>
              @endif
              @endif
              @if(!$clase->deliveries->where('user_id' , auth()->user()->id)->pluck('nota')->first())
              <li><div class="dropzone" id="dropzone1"></li>
              <li><button type="submit" class="btn btn-primary btn-block" id="enviarArchivo">Subir archivo</button></li>
              @endif
            </ol>
          </div>
          @endif
        </aside><!-- /.blog-sidebar -->

      </div><!-- /.row -->

    </main><!-- /.container -->
    @else
      <div class="alert alert-danger">
        <br><br>
              <strong>No estas autorizado para visualizar esta clase</strong>
      </div> 
    @endif
@endauth



<script>
Dropzone.autoDiscover = false;
var myDropzone = new Dropzone('.dropzone' , {
  url: "/upload/file/{{$clase->id}}",
  paramName: 'file',
  autoProcessQueue: false,
  maxFiles: 1,
  maxFileSize: 2,
  headers: {
    'X-CSRF-TOKEN' : '{{csrf_token()}}'
  },

  dictDefaultMessage: "Sube cualquier archivo a tu clase"
});
 myDropzone.on('error' ,function(file, res) {
  $('.dz-error-message:last span').text(res.errors.foto[0])
 });
  $('#enviarArchivo').click(function(){
      myDropzone.processQueue()
      setTimeout('document.location.reload()',800);
  });
</script>
@endsection