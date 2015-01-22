@extends('_base.dashboard')

@section('title')
	Dashboard
@stop

@section('sub-content')
	<h1 style="margin-top: 0; margin-bottom: 15px;"> Dashboard </h1>

	@if ( Session::has('authentication.success') )
		<div class="alert alet-success">
			Welcome back, {{ $profile->full_name }}. 
		</div>
	@endif

	<div class="clearfix">
		<img src="{{ $profile->avatar }}" style="width: 72px; height: 72px; border-radius: 15px; margin-right: 20px;" class="pull-left">
		<div class="pull-left">
			<h5> {{ $profile->full_name }} <small> ({{ $user->username }}) </small> </h5>

			<h6>
				<i class="ion-android-calendar"></i>
				{{ ( !is_null($profile->birthdate ) ) ? date('m d, Y', $profile->birthdate->timestamp) : 'Not set' }}

				<span style="margin-left: 5px; margin-right: 5px"> / </span>

				<i class="ion-ios-telephone"></i>
				{{  $profile->contact_no ?: 'Not set' }}
			</h6>
		</div>
	</div>

	<hr>

	<div class="alert alert-info">
		So far, you have appointed
		<strong>{{ $user->schedules->count() }}</strong> schedules, and
		<strong>{{ $user->records->count() }}</strong> records.
	</div>

	<div class="row">
		<div class="col-md-6">
			<h4> Records </h4>

			@if( $records->count() )
			<table class="table">
				<thead>
					<tr>
						<th> # </th>
						<th> Doctor </th>
					</tr>
				</thead>

				<tbody>
					@foreach($records as $record)
					<tr>
						<td> {{ $record->id }} </td>
						<td> {{ $record->doctor->name }} </td>
					</tr>
					@endforeach
				</tbody>
			</table>

			<a href="{{ route('dashboard.you.records.index') }}" class="btn btn-primary"> Check all records </a>
			@else
			<div class="alert alert-info">
				Oops, it seems that you have no records yet.
			</div>
			@endif
		</div>

		<div class="col-md-6">
			<h4> Schedules </h4>
			@if ( $schedules->count() )
			<table class="table">
				<thead>
					<tr>
						<th> # </th>
						<th> Date Appointed </th>
					</tr>
				</thead>

				<tbody>
					@foreach($schedules as $schedule)
					<tr>
						<td class="{{ $schedule->isDone() ? 'success' : '' }}"> {{ $schedule->id }} </td>
						<td class="{{ $schedule->isDone() ? 'success' : '' }}"> {{ $schedule->appointed_at->diffForHumans() }} </td>
					</tr>
					@endforeach
				</tbody>
			</table>

			<a href="{{ route('dashboard.you.schedules.index') }}" class="btn btn-primary"> Check all schedules </a>
			@else
			<div class="alert alert-info">
				Oops, it seems that you haven't made a schedule yet.
				Why don't you <a href="#" class="alert-link">appoint one</a>?
			</div>
			@endif
		</div>
	</div>
@stop