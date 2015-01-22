@extends('_base.dashboard')

@section('title')
	Create New User
@stop

@section('sub-content')
	<h1 style="margin-bottom: 25px;"> Create New User </h1>

	<form action="{{ route('dashboard.admin.users.store') }}" method="POST" style="width: 600px;" enctype="multipart/form-data">

		<h4> Account Details </h4>

		@if ( Session::has('admin.user.create.user.error') )
			<div class="alert alert-danger">
				{{ Session::get('admin.user.create.user.error') }}
			</div>
		@endif

		<div class="row form-group">
			<div class="col-md-6">
				<label> Username </label>
				<input type="text" name="username" class="form-control" placeholder="unique_data" value="{{Input::old('username')}}">
			</div>

			<div class="col-md-6">
				<label> Email </label>
				<input type="email" name="email" class="form-control" placeholder="your@email.com" value="{{Input::old('email')}}">
			</div>
		</div>

		<div class="row form-group">
			<div class="col-md-6">
				<label> Password </label>
				<input type="password" name="password" class="form-control" placeholder="*****">
			</div>

			<div class="col-md-6">
				<label> Password Confirmation </label>
				<input type="password" name="password_confirmation" class="form-control" placeholder="*****">
			</div>
		</div>

		<hr>
		<h4> Profile Details </h4>

		@if ( Session::has('settings.profile.success') )
			<div class="alert alert-success">
				{{ Session::get('settings.profile.success') }}
			</div>
		@endif

		@if ( Session::has('admin.user.create.profile.error') )
			<div class="alert alert-danger">
				{{ Session::get('admin.user.create.profile.error') }}
			</div>
		@endif

		<div class="clearfix" style="margin-bottom: 20px;">
			<img src="{{ asset('uploads/tuzki.png') }}" style="height: 100px; width: 100px; border-radius: 15px;" class="pull-left">
			<div style="width: 225px; margin-left: 25px; margin-top: 20px;" class="pull-left">
				<input type="file" class="form-control" name="avatar">

				<h4 class="text-center"> <small> Not required. </small> </h4>
			</div>
		</div>

		<div class="row form-group">
			<div class="col-md-4">
				<label> First Name </label>
				<input type="text" name="first_name" class="form-control" placeholder="Jealian" value="{{Input::old('first_name')}}">
			</div>

			<div class="col-md-4">
				<label> Middle Name </label>
				<input type="text" name="middle_name" class="form-control" placeholder="Enriquez" value="{{Input::old('middle_name')}}">
			</div>

			<div class="col-md-4">
				<label> Last Name </label>
				<input type="text" name="last_name" class="form-control" placeholder="Menor" value="{{Input::old('last_name')}}">
			</div>
		</div>

		<div class="row form-group">
			<div class="col-md-8">
				<label> Address </label>
				<input type="text" class="form-control" placeholder="523 Concha St." name="address" value="{{Input::old('address')}}">
			</div>

			<div class="col-md-4">
				<label> Birthdate </label>
				<div class="input-group">
					<input type="text" class="form-control datepicker" placeholder="11-23-1996" name="birthdate" value="{{Input::old('birthdate')}}">

					<span class="input-group-addon">
						<i class="ion-calendar"></i>
					</span>
				</div>
			</div>
		</div>

		<button type="submit" class="btn btn-success">
			<i class="ion-person"></i>
			Create User
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