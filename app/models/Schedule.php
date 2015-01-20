<?php

class Schedule extends Eloquent {

	/**
	 * Add automatically `appointed_at` converted-to-Carbon properties
	 */
	public function getDates()
	{
		return [
			'created_at',
			'updated_at',
			'appointed_at'
		];
	}

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