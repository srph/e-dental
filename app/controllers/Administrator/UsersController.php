<?php namespace Administrator;

use User;
use View;
use Ki\Common\Validators\User as UserValidator;

class UsersController extends \BaseController {

	/**
	 *
	 */
	public function __construct(UserValidator $validator)
	{
		$this->validator = $validator;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$users = User::paginate(20);

		return View::make('administrator.users.index', compact('users'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('administrator.users.create');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$user = User::findOrFail($id);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$user = User::findOrFail($id);

		return View::make('administrator.users.edit', compact('user'));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$input = Input::only([
			'username',
			'password',
			'email'
		]);

		try
		{
			$this->validator->validate($input);
		}
		catch(Exception $e)
		{
			Session::flash('admin.users.delete', $e->getMessages());
			Redirect::back();
		}

		$user = User::findOrFail($id);
		$user->username = $input['username'];
		$user->password = $input['password'];
		$user->email = $input['email'];

		return Redirect::back();
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		User::findOrFail($id)->delete();

		$message = 'User has been successfully deleted';
		Session::flash('admin.users.delete', $message);
		return Redirect::back();
	}


}
