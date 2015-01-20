<?php namespace Administrator;

use View;
use User;
use Session;
use Input;
use Schedule;
use Redirect;
use Ki\Validators\Schedule as ScheduleValidator;
use Ki\Common\Exceptions\ValidationException;

class SchedulesController extends \BaseController {

	public function __construct(ScheduleValidator $validator)
	{
		$this->validator = $validator;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$schedules = Schedule::orderBy('id', 'desc')->paginate(20);

		return View::make('administrator.schedules.index', compact('schedules'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$users = User::all();

		return View::make('administrator.schedules.create', compact('users'));
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::only([
			'appointed_at',
			'user_id'		
		]);

		try
		{
			$this->validator->validate($input);
		}
		catch(ValidationException $e)
		{
			Session::flash('administrator.schedules.create.error', $e->getMessage());
			return Redirect::back();
		}

		$user = User::find($input['user_id']);

		$schedule = new Schedule([
			'user_id'		=> $input['user_id'],
			'appointed_at'	=> date('Y-m-d', strtotime($input['appointed_at']))
		]);

		$schedule->save();

		$message = 'Success creating a schedule!';
		Session::flash('administrator.schedules.create.success', $message);
		return Redirect::route('dashboard.admin.schedule.index');

	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
