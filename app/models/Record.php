<?php

class Record extends Eloquent {

	/**
	 * 
	 */
	public function user()
	{
		return $this->belongsTo('User');
	}

	/**
	 *
	 */
	public function doctor()
	{
		return $this->belongsTo('Doctor');
	}

	/**
	 *
	 */
	public function service()
	{
		return $this->belongsTo('Service');
	}

	/**
	 *
	 */
	public function schedule()
	{
		return $this->belongsTo('Schedule');
	}


	/**
	 *
	 */
	public function hasSchedule()
	{
		return ! is_null($this->schedule);
	}

}