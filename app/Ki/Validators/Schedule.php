<?php namespace Ki\Validators;

use Ki\Common\AbstractValidator;

class Schedule extends AbstractValidator {

	public $rules = [
		'user_id'		=> 'required',
		'appointed_at'	=> 'required'
	];

}