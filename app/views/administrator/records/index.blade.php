@extends('_base.dashboard')

@section('title')
	Manage Records
@stop

@section('sub-content')
	<h1> Manage Records </h1>

	@if ( count($records) )
	<table class="table table-hover">
		<thead>
			<tr>
				<td> # </td>
				<td> Patient Name </td>
				<td> Doctor </td>
				<td> Service </td>
				<td> Scheduled Date </td>
			</tr>
		</thead>

		<tbody>
			@foreach($records as $record)
				<tr>
					<td> {{ $record->id }}  </td>
					<td> {{ $record->user->profile->full_name }} ({{ $record->user->username }}) </td>
					<td> {{ $record->doctor->name }} </td>
					<td> {{ $record->service->name }} </td>
					<td>
						@if ( $record->hasSchedule() )
							{{ $record->schedule->appointed_at->diffForHumans() }}
						@else
							<label class="label label-warning">
								Unscheduled
							</label>
						@endif
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>

	{{ $records->links() }}
	@endif
@stop