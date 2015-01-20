<?php

class Profile extends Eloquent {

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