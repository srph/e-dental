<?php

class Service extends Eloquent {

	/**
	 * Columns fillable by this model
	 */
	protected $fillable = ['name'];

	/**
	 * Disable the model's timestamp feature
	 */
	public $timestamps = false;

	/**
	 *
	 */
	public function records()
	{
		return $this->hasMany('records');
	}

	/**
	 *
	 */
	public function patients()
	{
		return $this->hasManyThrough('User', 'Record');
	}

	/**
	 *
	 */
	public function doctors()
	{
		return $this->hasManyThrough('User', 'Doctor');
	}

}