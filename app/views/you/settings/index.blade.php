@extends('_base.dashboard')

@section('title')
	Settings
@stop

@section('sub-content')
	<h1 style="margin-bottom: 25px;"> Settings </h1>

	<h4> Update Password </h4>

	@if ( Session::has('settings.profile.success') )
		<div class="alert alert-success">
			{{ Session::get('settings.profile.success') }}
		</div>
	@endif

	<form action="{{ route('dashboard.you.settings.user') }}" method="POST" style="width: 300px;">
		<input type="hidden" value="PUT" name="_method">

		<div class="form-group">
			<input type="password" name="old_password" class="form-control" placeholder="Old password..">
		</div>

		<div class="form-group">
			<input type="password" name="password" class="form-control" placeholder="New password..">
		</div>

		<div class="form-group">
			<input type="password" name="password_confirmation" class="form-control" placeholder="New password confirmation..">
		</div>

		<button type="submit" class="btn btn-danger">
			Change Password
		</button>
	</form>

	<hr>

	<h4> Update Profile </h4>

	@if ( Session::has('settings.user.success') )
		<div class="alert alert-success">
			{{ Session::get('settings.user.profile.success') }}
		</div>
	@endif

	<form action="{{ route('dashboard.you.settings.profile') }}" method="POST" style="width: 600px;">
		<input type="hidden" value="PUT" name="_method">

		<div class="row form-group">
			<div class="col-md-4">
				<label> First Name </label>
				<input type="text" name="first_name" class="form-control" placeholder="Jealian" value="{{ $profile->first_name }}">
			</div>

			<div class="col-md-4">
				<label> Middle Name </label>
				<input type="text" name="middle_name" class="form-control" placeholder="Enriquez" value="{{ $profile->middle_name }}">
			</div>

			<div class="col-md-4">
				<label> Last Name </label>
				<input type="text" name="last_name" class="form-control" placeholder="Menor" value="{{ $profile->last_name }}">
			</div>
		</div>

		<div class="row form-group">
			<div class="col-md-8">
				<label> Address </label>
				<input type="text" class="form-control" placeholder="523 Concha St." name="address" value="{{ $profile->address }}">
			</div>

			<div class="col-md-4">
				<label> Birthdate </label>
				<div class="input-group">
					<input type="text" class="form-control datepicker" placeholder="11-23-1996" name="birthdate" value="{{ $profile->birthdate->format('d/m/Y') }}">

					<span class="input-group-addon">
						<i class="ion-calendar"></i>
					</span>
				</div>
			</div>
		</div>

		<button type="submit" class="btn btn-success">
			Update Profile
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