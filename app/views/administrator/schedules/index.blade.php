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
	}
@stop