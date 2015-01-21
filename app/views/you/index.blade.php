@extends('_base.dashboard')

@section('title')
	Dashboard
@stop

@section('sub-content')
	<h1> Dashboard </h1>

	@if ( Session::has('authentication.success') )
		<div class="alert alet-success">
			Welcome back, {{ $profile->full_name }}. 
		</div>
	@endif
	<div class="alert alert-info">
		So far, you have appointed
		<strong>{{ $user->schedules->count() }}</strong> schedules, and
		<strong>{{ $user->records->count() }}</strong> records.
	</div>

	<img src="{{ $user->avatar }}">
@stop