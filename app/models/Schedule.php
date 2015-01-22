<?php

use Carbon\Carbon;

class Schedule extends Eloquent {

	/**
	 * Columns fillable by this model
	 */
	protected $fillable = array(
		'record_id',
		'appointed_at'
	);

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
	public function user()
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

	/**
	 * Checks if the appointment is done by
	 * checking the current date
	 *
	 * @return boolean
	 */
	public function isDone()
	{
		$now = Carbon::now();

		return $now->timestamp - $this->appointed_at->timestamp >= 0;
	}
}