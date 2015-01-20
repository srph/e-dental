<?php namespace Ki\Validators\User;

use Ki\Common\AbstractValidator;

class Record extends AbstractValidator{

	protected $rules = [
		'username'	=> 'required|min:3|alpha_dash',
		'password'	=> 'required|min:5',
		'email'		=> 'email'
	];

}