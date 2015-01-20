<?php

class Schedule extends Eloquent {

	/**
	 *
	 */
	public function patient()
	{
		return $this->belongsTo('User');
	}

	/**
	 *
	 */
	public function record()
	{
		return $this->hasOne('Record');
	}

	/**
	 *
	 */
	public function hasRecord()
	{
		return ! is_null($this->record);
	}
}