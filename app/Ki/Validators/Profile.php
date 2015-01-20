<?php namespace Ki\Validators;

use Ki\Common\AbstractValidator;

class Profile extends AbstractValidator {

	public $rules = [
		'first_name'	=> 'required|alpha_dash',
    	'middle_name'  => 'required|alpha_dash',
    	'last_name'  => 'required|alpha_dash'
	];

}