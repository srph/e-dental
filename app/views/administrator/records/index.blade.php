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
				<td> Schedule </td>
				<td> Actions </td>
			</tr>
		</thead>

		<tbody>
			@foreach($records as $record)
				<tr>
					<td> {{ $record->id }}  </td>
					<td> {{ $record->patient->profile->full_name }} ({{ $record->patient->username }}) </td>
					<td> {{ $record->doctor->name }} </td>
					<td> {{ $record->service->name }} </td>
					<td>
						@if ( $record->hasSchedule() )
							({{ $record->schedule->appointed_at }})
						@endif
					</td>
					<td> 
						<a href="{{ route('dashboard.admin.records.edit', $record->id) }}" class="btn btn-primary">
							<i class="ion-edit"></i>
						</a>
						<form action="{{ route('dashboard.admin.records.destroy') }}" style="display: inline-block;">
							<input type="hidden" value="_DELETE">
							<button type="form" data-delete-id="{{ $record->id }}" class="btn btn-danger"> <i class="ion-trash-b"></i> </button>
						</form>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	@endif
@stop