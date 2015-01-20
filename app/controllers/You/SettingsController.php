<?php namespace You;

use Redirect;
use View;
use Auth;
use Input;
use Session;
use Ki\Validators\User as UserValidator;
use Ki\Validators\Profile as ProfileValidator;

class SettingsController extends \BaseController {

  public function __construct(UserValidator $userValidator, ProfileValidator $profileValidator)
  {
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
      'old_password',
      'password',
      'password_confirmation'
    ]);

  	$user = Auth::user();
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

    $this->profileValidator->validate($input);

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