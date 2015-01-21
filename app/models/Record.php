<?php

class Record extends Eloquent {

	/**
	 * Columns fillable by the model
	 */
	protected $fillable = array(
		'user_id',
		'doctor_id',
		'schedule_id',
		'service_id',
		'first_name',
		'middle_name',
		'last_name',
		'full_name'
	);

	/**
	 * Transform the avatar attribute to a link
	 */
	public function getAvatarAttribute()
	{
		return url("uploads/{$this->avatar}");
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