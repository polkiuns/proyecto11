@extends('layouts.app')
@section('content')

<html>

<head>


	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" />

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    <link href="/css/treeview.css" rel="stylesheet">

	<div class="container">     

		<div class="panel panel-primary">

			<div class="panel-heading"></div>

	  		<div class="panel-body">

	  			<div class="row">

	  				<div class="col-md-12">

	  					<h3 style="text-align: center;">Lista de cursos</h3>

				        <div id="tree1">

				            @foreach($categories as $category)
								
								<h3>
				                <li>

				                    {{ $category->name }}

				                    @if(count($category->childs))

				                        @include('manageChild',['childs' => $category->childs])

				                    @endif

				                    @if(count($category->subjects))
										@include('manageSubjects',['subjects' => $category->subjects , 'course' => $category])
				                    @endif

				                </li>
				                </h3>

				            @endforeach

				        </div>

	  				</div>


	  			</div>


	  			

	  		</div>

        </div>

    </div>

    <script src="/js/treeview.js"></script>


@endsection