@extends('_base.dashboard')

@section('title')
	Appoint New Schedule
@stop

@section('sub-content')
	<h1> Appoint New Schedule </h1>

	@if ( Session::has('administrator.schedules.create.error') )
		<div class="alert alert-danger">
			{{ Session::get('administrator.schedules.create.error') }}
		</div>
	@endif

	<form action="{{ route('dashboard.admin.schedules.store') }}" method="POST" width="600px">
		<div class="row form-group">
			<div class="col-md-6">
				<label> User (Patient) </label>
				<select name="user_id" class="form-control">
					@foreach($users as $user)
						<option value="{{ $user->id }}">{{ $user->username }} ({{ $user->profile->full_name}})</option>
					@endforeach
				</select>
			</div>
		</div>

		<div class="row form-group">
			<div class="col-md-6">
				<label> Appointment Date </label>

				<div class="input-group">
					<input type="text" class="form-control datepicker" name="appointed_at">

					<span class="input-group-addon">
						<i class="ion-android-calendar"></i>
					</span>
				</div>
			</div>
		</div>

		<button type="submit" class="btn btn-success">
			<i class="ion-android-calendar"></i>
			Create New Appointment
		</button>
	</form>
@stop

@section('sub-scripts')
	<script>
		+function($) {
			$('.datepicker').datepicker({ format: 'mm-dd-yy' });
		}(jQuery);
	</script>
@stop