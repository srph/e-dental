<?php namespace Ki\Validators;

use Ki\Common\AbstractValidator;

class User extends AbstractValidator {

	public $rules = [
		'username'	=> 'required|min:3|alpha_dash',
		'password'	=> 'required|min:5|confirmed',
		'password_confirmation'	=> 'required',
		'email'		=> 'email'
	];

}