@extends('_base.dashboard')

@section('title')
	Manage Schedules
@stop

@section('sub-content')
	<h1> Manage Schedules </h1>

	@if ( count($schedules) )
	<table class="table table-hover">
		<thead>
			<tr>
				<td> # </td>
				<td> Username </td>
				<td> Full Name </td>
				<td> Actions </td>
			</tr>
		</thead>

		<tbody>
			@foreach($schedules as $schedule)
				<tr>
					<td> {{ $schedule->id }}  </td>
					<td> {{ $schedule->username }} </td>
					<td> {{ $schedule->profile->full_name }} </td>
					<td> 
						<a href="{{ route('dashboard.admin.schedules.edit', $schedule->id) }}" class="btn btn-primary">
							<i class="ion-edit"></i>
						</a>
						<form action="{{ route('dashboard.admin.schedules.destroy') }}" style="display: inline-block;">
							<input type="hidden" value="_DELETE">
							<button type="form" data-delete-id="{{ $schedule->id }}" class="btn btn-danger"> <i class="ion-trash-b"></i> </button>
						</form>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	@endif
@stop