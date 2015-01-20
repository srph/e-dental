@extends('_base.template')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-4">
				<div class="panel panel-default">
					<div class="panel-body">
						<ul class="list-group">
							<li class="list-group-item {{ is_active('admin.users') }}"> <a href="#">Your Records</a></li>
							<li class="list-group-item {{ is_active('admin.users') }}"> <a href="#">Your Schedules</a></li>
						</ul>
					</div>
				</div>

				<div class="panel panel-default">
					<div class="panel-body">
						<ul class="list-group">
							<li class="list-group-item {{ is_active('admin.users') }}"> <a href="#">Manage Users</a></li>
							<li class="list-group-item {{ is_active('admin.users') }}"> <a href="#">Manage Records</a></li>
							<li class="list-group-item {{ is_active('admin.users') }}"> <a href="#">Manage Schedules</a></li>
							<li class="list-group-item {{ is_active('admin.users') }}"> <a href="#">Reports</a></li>
						</ul>
					</div>
				</div>
			</div>

			<div class="col-md-8">
				<div class="panel panel-default">
					<div class="panel-body">
						@yield('content')
					</div>
				</div>
			</div>
		</div>
	</div>
@stop