@extends('_base.dashboard')

@section('title')
	Manage Users
@stop

@section('sub-content')
	<h1> Manage Users </h1>

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
						<form action="{{ route('dashboard.admin.users.destroy') }}" style="display: inline-block;">
							<input type="hidden" value="_DELETE">
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