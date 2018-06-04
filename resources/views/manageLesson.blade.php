
@foreach($childs as $child)

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
	@if(count($child->childs))
			

            @include('manageLesson',['childs' => $child->childs , 'subject' => $subject])
	

    @endif
                      </ul>
                       </div>
                       </div>
                      </div>

@endforeach

