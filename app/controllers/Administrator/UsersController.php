<?php namespace Administrator;

use User;
use View;
use Input;
use Session;
use Redirect;
use Ki\Validators\User as UserValidator;
use Ki\Validators\Profile as ProfileValidator;
use Ki\Common\Exceptions\ValidationException;
use Profile;

class UsersController extends \BaseController {

	/**
	 *
	 */
	public function __construct(UserValidator $userValidator, ProfileValidator $profileValidator)
	{
		$this->userValidator = $userValidator;
		$this->profileValidator = $profileValidator;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$users = User::orderBy('id', 'desc')->paginate(20);

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
		$input = Input::only([
			'username',
			'email',
			'password',
			'password_confirmation',
			'first_name',
			'middle_name',
			'last_name',
			'address',
			'birthdate'
		]);

		try
		{
			$this->userValidator->validate($input);
		}
		catch(ValidationException $e)
		{
			Session::flash('admin.user.create.user.error', $e->getMessage());
			return Redirect::back()->withInput();
		}

		try
		{
			$this->profileValidator->validate($input);
		}
		catch(ValidationException $e)
		{
			Session::flash('admin.user.create.profile.error', $e->getMessage());
			return Redirect::back()->withInput();
		}

		$user = new User;
		$user->email = $input['email'];
		$user->password = $input['password'];
		$user->save();

		$profile = new Profile;
		$profile->first_name = $input['first_name'];
		$profile->middle_name = $input['middle_name'];
		$profile->last_name = $input['last_name'];
		$profile->full_name = "{$input['first_name']} {$input['middle_name']} {$input['last_name']}";
	    if ( Input::has('address') )
	    {
	      $profile->address = $input['address'];
	    }

	    if ( Input::has('birthdate') )
	    {
	      $profile->birthdate = date('Y-m-d', strtotime($input['birthdate']));
	    }

	  	$user->profile()->save($profile);


		$message = 'User has been successfully created!';
		Session::flash('admin.user.create.success', $message);
		Redirect::to('dashboard.you.settings.index');
	}


	/**
	 * Display the specified resource.
	 *
	 * @param	int	$id
	 * @return Response
	 */
	public function show($id)
	{
		$user = User::findOrFail($id);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param	int	$id
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
	 * @param	int	$id
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
	 * @param	int	$id
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
