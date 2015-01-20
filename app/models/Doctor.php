<?php

class Doctor extends Eloquent {

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