<?php namespace Ki\Common;

use Validator;
use Ki\Common\Exceptions\ValidationException;

abstract class AbstractValidator {

	/**
	 * Validation rules
	 */
	public $rules = array();

	/**
	 * Execute validation
	 */
	public function validate(array $input, array $rules = array(), $override = false)
	{
		$rules = !count($rules)
			? $this->rules
			: ($override ? $rules : array_merge($this->rules, $rules));

		$validation = Validator::make($input, $rules);

		if ( $validation->fails() )
		{
			throw new ValidationException( $validation->messages() );
		}
	}
}