<?php

class AuthController extends BaseController {

	/**
	 * Authentication form
	 */
	public function getLogin()
	{
		return View::make('auth.login');
	}

	/**
	 * Process authentication
	 */
	public function postLogin()
	{
		$credentials = [
			'username'	=> Input::get('username'),
			'password'	=> Input::get('password')
		];

		if ( Auth::attempt($credentials) )
		{
			return Redirect::route('dashboard.index');
		}

		$error = 'Invalid username / password';
		Session::flash('authentication.error', $error);

		return Redirect::back();
	}

	/**
	 * Logout the authenticated
	 */
	public function getLogout()
	{
		if ( Auth::check() )
		{
			$message = 'You have been logged out successfully!';
			Session::flash('authentication.logout', $message);

			Auth::logout();
		}

		return Redirect::route('auth.login');
	}

}