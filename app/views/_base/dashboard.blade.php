@extends('_base.template')

@section('style')
	<style>
	body {
		min-height: 100vh;
	}

	.container {
		padding-top: 50px;
		padding-bottom: 50px;
	}
	</style>
@stop

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-4">
				<div class="panel panel-default">
					<div class="panel-heading">User Panel</div>
					<ul class="list-group">
						<li class="list-group-item {{ _active('admin.users.index') }}"> <a href="#">Your Records</a></li>
						<li class="list-group-item {{ _active('admin.users') }}"> <a href="#">Your Schedules</a></li>
					</ul>
				</div>

				<div class="panel panel-default">
					<div class="panel-heading">Administrator Panel</div>
					<ul class="list-group">
						<li class="list-group-item {{ _active('admin.users') }}"> <a href="{{ route('admin.users.index') }}">Manage Users</a></li>
						<li class="list-group-item {{ _active('admin.users') }}"> <a href="url('dashboard/admin/records')">Manage Records</a></li>
						<li class="list-group-item {{ _active('admin.users') }}"> <a href="#">Manage Schedules</a></li>
						<li class="list-group-item {{ _active('admin.users') }}"> <a href="#">Reports</a></li>
					</ul>
				</div>
			</div>

			<div class="col-md-8">
				<div class="panel panel-default">
					<div class="panel-body">
						@yield('sub-content')
					</div>
				</div>
			</div>
		</div>
	</div>
@stop