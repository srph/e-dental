@extends('_base.dashboard')

@section('title')
	Manage Records
@stop

@section('sub-content')
	<div class="clearfix" style="margin-bottom: 20px;">
		<h1 style="margin-top: 0;" class="pull-left"> Manage Records </h1>
		<a href="{{ route('dashboard.admin.records.create') }}" class="btn btn-info pull-right">
			<i class="ion-document"></i>
			Create New Record
		</a>
	</div>

	@if ( Session::has('administrator.records.create.success') )
		<div class="alert alert-success">
			{{ Session::get('administrator.records.create.success') }}
		</div>
	@endif

	@if ( count($records) )
	<table class="table table-hover">
		<thead>
			<tr>
				<td> # </td>
				<td> Patient </td>
				<td> Doctor </td>
				<td> Service </td>
				<td> Scheduled Date </td>
			</tr>
		</thead>

		<tbody>
			@foreach($records as $record)
				<tr>
					<td> {{ $record->id }}  </td>
					<td> {{ $record->full_name }} ({{ ($record->user->username) }}) </td>
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