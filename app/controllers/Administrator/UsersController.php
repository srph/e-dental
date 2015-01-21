<?php namespace Administrator;

use User;
use View;
use Input;
use Session;
use Redirect;

use Profile;

use Ki\Validators\User as UserValidator;
use Ki\Validators\Profile as ProfileValidator;
use Ki\Common\Exceptions\ValidationException;
use Ki\Common\Uploader\UploaderInterface;


class UsersController extends \BaseController {

	/**
	 *
	 */
	public function __construct(
		UploaderInterface $uploader,
		UserValidator $userValidator,
		ProfileValidator $profileValidator
	)
	{
		$this->uploader = $uploader;
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

		return $this->view('administrator.users.index', compact('users'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return $this->view('administrator.users.create');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		// Sanitize the input fields
		// to be used within this request
		$input = $this->input([
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

		// Validate user data
		try
		{
			// Catch invalid data
			$this->userValidator->validate($input);
		}
		catch(ValidationException $e)
		{
			$key = 'admin.user.create.user.error';
			return $this
				->flash($key, $e->getMessage())
				->back();
		}

		// Validate profile data
		try
		{
			// Catch invalid data
			$this->profileValidator->validate($input);
		}
		catch(ValidationException $e)
		{
			$key = 'admin.user.create.profile.error';

			return $this
				->flash($key, $e->getMessage());
				->back();
		}

		// Let's create the User model from the input
		$user = new User;
		$user->email 	= $input['email'];
		$user->password = $input['password'];

		// And then create its Profile
		$profile = new Profile;
		$profile->first_name 	= $input['first_name'];
		$profile->middle_name 	= $input['middle_name'];
		$profile->last_name 	= $input['last_name'];
		$profile->full_name 	= "{$input['first_name']} {$input['middle_name']} {$input['last_name']}";
	    $profile->address 		= $input['address'] ?: null;
	    $profile->birthdate 	= date('Y-m-d', strtotime($input['birthdate'] ?: null) );

	    // Save the user along with its relationship
	    $user->save();
	  	$user->profile()->save($profile);

		$message = 'User has been successfully created!';

		return $this
			->flash('admin.user.create.success', $message);
			->redirect('dashboard.you.settings.index');
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

		return $this->view('administrator.users.edit', compact('user'));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param	int	$id
	 * @return Response
	 */
	public function update($id)
	{
		// Sanitize the input fields
		// to be used within this request
		$input = $this->input(['username', 'password', 'email']);

		try
		{
			$this->validator->validate($input);
		}
		catch(Exception $e)
		{
			$key = 'admin.users.update.error';

			$this
				->flash($key, $e->getMessages())
				->back();
		}

		$user = User::findOrFail($id);
		$user->username = $input['username'];
		$user->password = $input['password'];
		$user->email 	= $input['email'];

		return $this->back();
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
		
		return $this
			->flash('admin.users.delete', $message);
			->back(false);
	}


}