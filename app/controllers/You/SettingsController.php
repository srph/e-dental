<?php namespace You;

use View;
use Auth;
use Session;

class SettingsController extends \BaseController {

	public function index()
	{
		$user = Auth::user();
		$profile = $user->profile;

		return View::make('you.settings.index', compact('user', 'profile'));
	}

  public function user()
  {
  	$user = Auth::user();
  	$user->save();


  	$message = 'Your account has been successfully updated!';
  	Session::flash('settings.user.update.success', $message);
  	Redirect::to('dashboard.you.settings.index');
  }

  public function profile()
  {
  	$profile = Auth::user()->profile;
  	$profile->save();

  	$message = 'Your profile has been successfully updated!';
  	Session::flash('settings.user.profile.success', $message);
  	Redirect::to('dashboard.you.settings.index');
  }

}