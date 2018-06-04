@extends('admin.layouts.layout')

@section('content')

<h1>Holiwis</h1>
<p>Usuario auntenticado: {{auth()->user()->email}}</p>

@endsection