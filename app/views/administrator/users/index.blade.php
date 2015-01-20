@extends('_base.dashboard')

@section('title')
	Manage Users
@stop

@section('sub-content')
	<h1> Manage Users </h1>

	@if ( count($users) )
	<table class="table">
		<thead>
			<tr>
				<td> # </td>
				<td> Username </td>
				<td> Full Name </td>
				<td> Actions </td>
			</tr>
		</thead>

		<tbody>
			@foreach($users as $user)
				<tr>
					<td> {{ $user->id }}  </td>
					<td> {{ $user->username }} </td>
					<td> {{ $user->full_name }} </td>
					<td> 
						<a href="#" class="btn btn-primary"> <i class="ion-pencil"></i> </a>
						<form action="{{ route('dashboard.admin.users.destroy') }}">
							<input type="hidden" value="_DELETE">
							<button type="form" data-delete-id="{{ $user->id }}"> <i class="ion-trash"></i> </button>
						</form>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	@endif
@stop