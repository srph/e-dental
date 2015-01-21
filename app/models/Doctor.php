<?php

class Doctor extends Eloquent {

	/**
	 * Columns fillable by this model
	 */
	protected $fillable = array('name');

	/**
	 * Disable the model's timestamp feature
	 */
	public $timestamps = false;

	/**
	 *
	 */
	public function patients()
	{
		return $this->hasMany('User');
	}

	/**
	 *
	 */
	public function services()
	{
		return $this->hasManyThrough('Service', 'User');
	}
}