<ul>
@foreach($childs as $child)

	<li>

	     <a id="" href="#">{{ $child->name }}</a>

	@if(count($child->childs))
			

            @include('manageChild',['childs' => $child->childs])
	

    @endif
    @if(count($child->subjects) && !isset($noSubject))

			@include('manageSubjects',['subjects' => $child->subjects , 'course' => $child])

	@endif

	</li>


@endforeach

</ul>
