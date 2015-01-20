@extends('_base.dashboard')

@section('title')
	Submit New Record
@stop

@section('sub-content')
	<h1> Submit New Record </h1>

	@if ( Session::has('administrator.records.create.error') )
		<div class="alert alert-danger">
			{{ Session::get('administrator.records.create.error') }}
		</div>
	@endif

	<form action="{{ route('dashboard.admin.records.store') }}" method="POST" width="600px">
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
				<label> Service </label>
				<select name="doctor_id" class="form-control">
					@foreach($doctors as $doctor)
						<option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
					@endforeach
				</select>
			</div>
		</div>

		<div class="row form-group">
			<div class="col-md-6">
				<label> Service </label>
				<select name="service_id" class="form-control">
					@foreach($services as $service)
						<option value="{{ $service->id }}">{{ $service->name }}</option>
					@endforeach
				</select>
			</div>
		</div>

		<button type="submit" class="btn btn-success">
			<i class="ion-document"></i>
			Create New Record
		</button>
	</form>
@stop