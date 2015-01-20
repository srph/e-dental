<?php

class Service extends Eloquent {

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