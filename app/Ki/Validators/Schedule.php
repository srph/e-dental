<?php namespace Ki\Validators;

use Ki\Common\AbstractValidator;

class Schedule extends AbstractValidator {

	public $rules = [
		'username'	=> 'required|min:3|alpha_dash',
		'password'	=> 'required|min:5',
		'email'		=> 'email'
	];

}