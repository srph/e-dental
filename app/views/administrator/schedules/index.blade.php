@extends('_base.dashboard')

@section('title')
	Manage Schedules
@stop

@section('sub-content')
	<div class="clearfix">
		<h1 style="margin-top: 0; margin-bottom: 25px;" class="pull-left"> Manage Schedules </h1>
		<a href="{{ route('dashboard.admin.schedules.create') }}" class="btn btn-info pull-right">
			<i class="ion-android-calendar"></i>
			Create New Appointment
		</a>
	</div>

	@if ( Session::has('administrator.schedules.create.success') )
		<div class="alert alert-danger">
			{{ Session::get('administrator.schedules.create.success') }}
		</div>
	@endif

	@if ( count($schedules) )
	<table class="table table-hover">
		<thead>
			<tr>
				<td> # </td>
				<td> Patient's Full Name </td>
				<td> Date Appointed </td>
				<td> Date Created </td>
			</tr>
		</thead>

		<tbody>
			@foreach($schedules as $schedule)
				<tr>
					<td> {{ $schedule->id }}  </td>
					<td>
						{{ $schedule->user->username }}
						({{ $schedule->user->profile->full_name }})
					</td>
					<td> {{ $schedule->appointed_at->diffForHumans() }} </td>
					<td> {{ $schedule->created_at->diffForHumans() }} </td>
				</tr>
			@endforeach
		</tbody>
	</table>

	{{ $schedules->links() }}
	@endif
@stop