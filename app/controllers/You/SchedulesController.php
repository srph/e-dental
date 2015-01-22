<?php namespace You;

use Auth;
use View;
use Schedule;
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
		$schedules = Auth::user()
			->schedules()
			->orderBy('id', 'desc')
			->paginate(20);

		return $this->view('you.schedules.index', compact('schedules'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return $this->view('you.schedules.create');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = $this->input('appointed_at');

		try
		{
			$this->validator->validate($input, ['user_id' => '']);
		}
		catch(ValidationException $e)
		{
			$key = 'you.schedules.create.error';

			return $this
				->flash($key, $e->getMessage())
				->back();
		}

		$user = Auth::user();
		$appointed_at = date('Y-m-d', strtotime($input['appointed_at']));
		$schedule = new Schedule(['appointed_at' => $appointed_at]);
		$user->schedules()->save($schedule);

		$message = 'Success appointing a schedule!';

		return $this
			->flash('you.schedules.create.success', $message)
			->redirect('dashboard.you.schedules.index');

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
