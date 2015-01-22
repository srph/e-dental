@extends('_base.dashboard')

@section('title')
	Edit User
@stop

@section('sub-content')
	<h1 style="margin-bottom: 25px;"> Settings </h1>

	<h4> Update Password </h4>

	@if ( Session::has('admin.users.update.success') )
		<div class="alert alert-success">
			{{ Session::get('admin.users.update.success') }}
		</div>
	@endif

	@if ( Session::has('admin.users.update.error') )
		<div class="alert alert-danger">
			{{ Session::get('admin.users.update.error') }}
		</div>
	@endif

	<form action="{{ route('dashboard.admin.users.update', $user->id) }}" method="POST" style="width: 600px;">
		<input type="hidden" value="PUT" name="_method">

		<!-- <div class="form-group">
			<input type="password" name="old_password" class="form-control" placeholder="Old password..">
		</div> -->
		<div class="row form-group">
			<div class="col-md-6">
				<label> Username </label>
				<input type="text" name="username" class="form-control" placeholder="unique_data"  value="{{ $user->username }}">
			</div>

			<div class="col-md-6">
				<label> Email </label>
				<input type="email" name="email" class="form-control" placeholder="unique@data.com" value="{{ $user->email }}">
			</div>
		</div>		

		<div class="row form-group">
			<div class="col-md-6">
				<label> New Password </label>
				<input type="password" name="password" class="form-control" placeholder="New password..">
			</div>

			<div class="col-md-6">
				<label> New Password Confirmation </label>
				<input type="password" name="password_confirmation" class="form-control" placeholder="New password confirmation..">
			</div>
		</div>

		<button type="submit" class="btn btn-danger">
			Update Account
		</button>
	</form>

	<hr>

	<h4> Update Profile </h4>

	@if ( Session::has('admin.profile.update.success') )
		<div class="alert alert-success">
			{{ Session::get('admin.profile.update.success') }}
		</div>
	@endif

	@if ( Session::has('admin.profile.update.error') )
		<div class="alert alert-danger">
			{{ Session::get('admin.profile.update.error') }}
		</div>
	@endif

	<form action="{{ route('dashboard.admin.users.profile.update', $profile->id) }}" method="POST" style="width: 600px;" enctype="multipart/form-data">
		<input type="hidden" value="PUT" name="_method">

		<div class="clearfix" style="margin-bottom: 20px;">
			<img src="{{ $profile->avatar }}" style="height: 100px; width: 100px; border-radius: 15px;" class="pull-left">
			<div style="width: 225px; margin-left: 25px; margin-top: 20px;" class="pull-left">
				<input type="file" class="form-control" name="avatar">

				<h4 class="text-center"> <small> Select a file to replace the current </small> </h4>
			</div>
		</div>

		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label> First Name </label>
					<input type="text" name="first_name" class="form-control" placeholder="Jealian" value="{{ $profile->first_name }}">
				</div>

				<div class="form-group">
					<label> Middle Name </label>
					<input type="text" name="middle_name" class="form-control" placeholder="Enriquez" value="{{ $profile->middle_name }}">
				</div>

				<div class="form-group">
					<label> Last Name </label>
					<input type="text" name="last_name" class="form-control" placeholder="Menor" value="{{ $profile->last_name }}">
				</div>
			</div>

			<div class="col-md-6">
				<div class="form-group">
					<label> Address </label>
					<input type="text" class="form-control" placeholder="523 Concha St." name="address" value="{{ $profile->address }}">
				</div>

				<div class="form-group">
					<label> Birthdate </label>
					<div class="input-group">
						<input type="text" class="form-control datepicker" placeholder="11-23-1996" name="birthdate" value="{{ $profile->birthdate }}">

						<span class="input-group-addon">
							<i class="ion-calendar"></i>
						</span>
					</div>
				</div>

				<div class="form-group">
					<label> Contact # </label>
					<input type="text" class="form-control" placeholder="+(63)916-441-7383" name="contact_no" value="{{ $profile->contact_no }}">
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
			$('.datepicker').datepicker({ format: 'dd-mm-yy' });
		}(jQuery);
	</script>
@stop