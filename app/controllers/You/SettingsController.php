<?php namespace You;

use Redirect;
use View;
use Auth;
use Input;
use Session;

use Ki\Validators\User as UserValidator;
use Ki\Validators\Profile as ProfileValidator;
use Ki\Common\Exceptions\ValidationException;

use Ki\Common\Uploader\UploaderInterface;
use Ki\Common\Uploader\UploadFailedException;

class SettingsController extends \BaseController {

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

	public function index()
	{
		$user = Auth::user();
		$profile = $user->profile;

		return View::make('you.settings.index', compact('user', 'profile'));
	}

	public function user()
	{
		$input = Input::only([
			'password',
			'password_confirmation'
		]);

		try
		{
			$rules =  ['username' => '', 'email' => ''];
			$this->userValidator->validate($input, $rules);
		}
		catch(ValidationException $e)
		{
			Session::flash('settings.user.error', $e->getMessage());
			return Redirect::back();
		}

		$user = Auth::user();
		$user->password = $input['password'];
		$user->save();


		$message = 'Your account has been successfully updated!';
		Session::flash('settings.user.success', $message);
		Redirect::to('dashboard.you.settings.index');
	}

	public function profile()
	{
		$input = $this->input([
			'first_name',
			'middle_name',
			'last_name',
			'address',
			'birthdate',
			'avatar',
			'contact_no'
		]);

		try
		{
			$this->profileValidator->validate($input);
		}
		catch(ValidationException $e)
		{
			return $this
				->flash('settings.profile.error', $e->getMessage())
				->back();
		}

		$profile = Auth::user()->profile;
		$profile->first_name = $input['first_name'];
		$profile->middle_name = $input['middle_name'];
		$profile->last_name = $input['last_name'];
		$profile->full_name = "{$input['first_name']} {$input['middle_name']} {$input['last_name']}";
		$profile->contact_no = $input['contact_no'];
		$profile->address 	= Input::has('address') ? $input['address'] : null;
		$profile->birthdate = Input::has('birthdate') ? date('Y-m-d', strtotime($input['birthdate'])) : null;
		if(Input::hasFile('avatar')) $profile->avatar 	= $this->uploader->upload($input['avatar']);
		$profile->save();

		$message = 'Your profile has been successfully updated!';
		Session::flash('settings.profile.success', $message);
		return Redirect::back();
	}

}