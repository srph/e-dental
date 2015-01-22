<?php namespace You;

use View;
use Auth;
use Session;

class DashboardController extends \BaseController {

	public function index()
	{
		$user = Auth::user();
		$profile = $user->profile;
		$schedules = $user->schedules()->take(5)->get();
		$records = $user->records()->take(5)->get();

		return View::make('you.index',
			compact('user', 'schedules', 'records', 'profile'));
	}

}