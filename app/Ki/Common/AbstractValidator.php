<?php namespace Ki\Common;

use Ki\Common\Exceptions\ValidationException;

abstract class AbstractValidation {

	/**
	 * Validation rules
	 */
	protected $rules = [];

	/**
	 * Execute validation
	 */
	public function validate($input, array $rules = array(), $override = true)
	{
		$rules = !count($rules)
			? $this->rules
			: $override ? $rules : array_merge($this->rules, $rules);

		$validation = Validator::make($input, $rules);

		if ( $validations->fails() )
		{
			throw new ValidationException( $validation->messages() );
		}
	}
}