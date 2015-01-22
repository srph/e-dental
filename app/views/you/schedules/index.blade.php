@extends('_base.dashboard')

@section('title')
	Your Schedules
@stop

@section('sub-content')
	<div class="clearfix">
		<h1 class="pull-left" style="margin-top: 0; margin-bottom: 20px;"> Your Schedules </h1>

		<a href="{{ route('dashboard.you.schedules.create') }}" class="btn btn-info pull-right">
			<i class="ion-android-calendar"></i>
			Set An Appointment
		</a>
	</div>

	@if( Session::has('you.schedules.create.success') )
		<div class="alert alert-success">
			{{ Session::get('you.schedules.create.success') }}
		</div>
	@endif

	@if ( count($schedules) )
	<table class="table table-hover">
		<thead>
			<tr>
				<td> # </td>
				<td> Date Appointed </td>
				<td> Date Created </td>
			</tr>
		</thead>

		<tbody>
			@foreach($schedules as $schedule)
				<tr>
					<td class="{{ $schedule->isDone() ? 'success' : '' }}"> {{ $schedule->id }}  </td>
					<td class="{{ $schedule->isDone() ? 'success' : '' }}"> {{ $schedule->appointed_at->diffForHumans() }} </td>
					<td class="{{ $schedule->isDone() ? 'success' : '' }}"> {{ $schedule->created_at->diffForHumans() }} </td>
				</tr>
			@endforeach
		</tbody>
	</table>

	{{ $schedules->links() }}
	@endif
@stop