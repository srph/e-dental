<?php namespace Ki\Validators;

use Ki\Common\AbstractValidator;

class Record extends AbstractValidator{

	public $rules = [
		'user_id'		=> 'required',
		'service_id'	=> 'required',
		'doctor_id'		=> 'required'
	];

}