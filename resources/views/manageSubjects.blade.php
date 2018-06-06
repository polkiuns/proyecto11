<ul>

@foreach($subjects as $subject)

	<li>
		@if(isset($course))
	     <a style="color:green;" id="" href="{{route('subjects.index' , array($course , $subject))}}">{{ $subject->name }}</a>
		@else
		<a style="color:green;" id="" href="#">{{ $subject->name }}</a>
		@endif
	@if(count($subject->subjects))
			

            @include('manageSubjects',['subjects' => $child->subjects])
			
	


    @endif



	</li>


@endforeach

</ul>
