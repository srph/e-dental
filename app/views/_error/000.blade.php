@extends('_base.template')

@section('title')
	Resource Not Found
@stop

@section('content')
	<div class="text-center" style="margin-top: 25px; margin-bottom: 25px;">
		<img src="{{ asset('error.png') }} ">
		<h1> 420 Unauthorized Access </h1>
		<h4> It seems that you do not have the permission to access this content. </h4>
	</div>
@stop