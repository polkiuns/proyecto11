<ul>

@foreach($subjects as $subject)

	<li>

	     <a style="color:green;" id="" href="{{route('subjects.index' , array($course , $subject))}}">{{ $subject->name }}</a>

	@if(count($subject->subjects))
			

            @include('manageSubjects',['subjects' => $child->subjects])
			
	


    @endif



	</li>


@endforeach

</ul>
