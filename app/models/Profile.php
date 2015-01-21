<?php

class Profile extends Eloquent {

	/**
	 * Columns fillable by this model
	 */
	protected $fillable = array(
		'user_id',
		'first_name',
		'middle_name',
		'last_name',
		'full_name',
		'address',
		'birthdate',
		'avatar'
	);

	/**
	 *
	 */
	public function getDates()
	{
		return [
			'created_at',
			'updated_at',
			'birthdate'
		];
	}
	
	/**
	 *
	 */
	public function user()
	{
		return $this->belongsTo('User');
	}
}