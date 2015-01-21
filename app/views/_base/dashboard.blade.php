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

	@yield('sub-styles')
@stop

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-4">
				<div class="panel panel-default">
					<div class="panel-heading">User Panel</div>
					<div class="list-group">
						<a class="list-group-item {{ _active('dashboard.index', false) }}" href="{{ route('dashboard.index') }}">Dashboard</a>
						<a class="list-group-item {{ _active('dashboard.you.settings') }}" href="{{ route('dashboard.you.settings.index') }}">Settings</a>
						<a class="list-group-item {{ _active('dashboard.you.schedules') }}" href="{{ route('dashboard.you.schedules.index') }}">Your Schedules</a>
						<a class="list-group-item {{ _active('dashboard.you.records') }}" href="{{ route('dashboard.you.records.index') }}">Your Records</a>
					</div>
				</div>

				@if ( Auth::user()->is_admin )
				<div class="panel panel-default">
					<div class="panel-heading">Administrator Panel</div>
					<div class="list-group">
						<a class="list-group-item {{ _active('dashboard.admin.users') }}" href="{{ route('dashboard.admin.users.index') }}">Manage Users</a>
						<a class="list-group-item {{ _active('dashboard.admin.records') }}" href="{{ route('dashboard.admin.records.index') }}">Manage Records</a>
						<a class="list-group-item {{ _active('dashboard.admin.schedules') }}" href="{{ route('dashboard.admin.schedules.index') }}">Manage Schedules</a>
						<a class="list-group-item {{ _active('dashboard.admin.reports') }}" href="{{ route('dashboard.admin.users.index') }}">Reports</a>
					</div>
				</div>
				@endif

				<div class="panel panel-default">
					<div class="list-group">
						<a class="list-group-item" href="{{ route('auth.logout') }}">
							<i class="ion-close-circled"></i>
							Logout
						</a>
					</div>
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

@section('scripts')
	{{ HTML::script('assets/bootstrap-datepicker/js/bootstrap-datepicker.js') }}

	<script>
		+function($) {
			var $dlt = $('[data-delete-id]');

			$dlt.on('click', function(evt) {
				if ( !confirm('Are you sure to delete this?') )
					evt.preventDefault();
			})
		}(jQuery);
	</script>

	@yield('sub-scripts')
@stop