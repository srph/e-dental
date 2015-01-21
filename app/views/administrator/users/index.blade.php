@extends('_base.dashboard')

@section('title')
	Manage Users
@stop

@section('sub-content')
	<div class="clearfix">
		<h1 class="pull-left"> Manage Users </h1>
		<a href="{{ route('dashboard.admin.users.create') }}" class="btn btn-info pull-right">
			<i class="ion-person"></i>
			Create New User
		</a>
	</div>

	@if ( Session::has('admin.user.create.success') )
		<div class="alert alert-success">
			{{ Session::get('admin.user.create.success') }}
		</div>
	@endif

	@if ( Session::has('admin.user.update.success') )
		<div class="alert alert-success">
			{{ Session::get('admin.user.update.success') }}
		</div>
	@endif

	@if ( Session::has('admin.users.delete') )
		<div class="alert alert-success">
			{{ Session::get('admin.users.delete') }}
		</div>
	@endif

	@if ( count($users) )
	<table class="table table-hover">
		<thead>
			<tr>
				<td> # </td>
				<td> Username </td>
				<td> Full Name </td>
				<td style="min-width:125px;"> Actions </td>
			</tr>
		</thead>

		<tbody>
			@foreach($users as $user)
				<tr>
					<td> {{ $user->id }}  </td>
					<td> {{ $user->username }} </td>
					<td> {{ $user->profile->full_name }} </td>
					<td> 
						<a href="{{ route('dashboard.admin.users.edit', $user->id) }}" class="btn btn-primary">
							<i class="ion-edit"></i>
						</a>
						<form action="{{ route('dashboard.admin.users.destroy', $user->id) }}" method="POST" style="display: inline-block;">
							<input type="hidden" value="DELETE" name="_method">
							<button type="form" data-delete-id="{{ $user->id }}" class="btn btn-danger"> <i class="ion-trash-b"></i> </button>
						</form>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>

	{{ $users->links() }}
	@endif
@stop