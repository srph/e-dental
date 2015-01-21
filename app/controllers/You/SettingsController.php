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
		$input = Input::only([
			'first_name',
			'middle_name',
			'last_name',
			'address',
			'birthdate'
		]);

		try
		{
			$this->profileValidator->validate($input);
		}
		catch(ValidationException $e)
		{
			Session::flash('settings.profile.error', $e->getMessage());
			return Redirect::back();
		}

		$profile = Auth::user()->profile;
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

		$profile->save();

		$message = 'Your profile has been successfully updated!';
		Session::flash('settings.profile.success', $message);
		return Redirect::back();
	}

}