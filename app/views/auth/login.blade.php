@extends('_base.template')

@section('title')
	Sign In
@stop

@section('style')
	<style>
		.container {
			min-height: 100vh;
			padding-top: 25px;
			padding-bottom: 25px;
		}

		.outer-container {
			display: table;
			width: 100%;
			height: 100vh;
		}

		.inner-container {
			display: table-cell;
			vertical-align: middle;
		}

		.panel {
			width: 450px;
			margin-left: auto;
			margin-right: auto;
		}
	</style>
@stop

@section('content')
	<div class="container">
		<div class="outer-container">
			<div class="inner-container">
				<div class="panel panel-default">
					<div class="panel-heading"> Welcome back! </div>

					<div class="panel-body">
						@if ( Session::has('authentication.error') )
							<div class="alert alert-danger text-center">
								{{ Session::get('authentication.error') }}
							</div>
						@endif

						@if ( Session::has('authentication.logout') )
							<div class="alert alert-success text-center">
								{{ Session::get('authentication.logout') }}
							</div>
						@endif

						<form method="POST" action="{{ route('auth.auth') }}">
							<div class="form-group">
								<label> Username </label>
								<input type="text" class="form-control" name="username">
							</div>

							<div class="form-group">
								<label> Password </label>
								<input type="password" class="form-control" name="password">
							</div>

							<button type="submit" class="btn btn-success">
								Login
							</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
@stop