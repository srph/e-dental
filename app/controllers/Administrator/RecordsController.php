<?php namespace Administrator;

use View;
use Record;
use User;
use Input;
use Doctor;
use Session;
use Redirect;
use Service;
use Ki\Validators\Record as RecordValidator;
use Ki\Common\Exceptions\ValidationException;

class RecordsController extends \BaseController {

	public function __construct(RecordValidator $validator)
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
		$records = Record::with('user.profile')->orderBy('id', 'desc')->paginate(20);

		// return \Response::json($records);
		return View::make('administrator.records.index', compact('records'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$users = User::all();
		$services = Service::all();
		$doctors = Doctor::all();

		return View::make('administrator.records.create', compact('users', 'services', 'doctors'));
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::only([
			'user_id',
			'service_id',
			'doctor_id'
		]);

		try
		{
			$this->validator->validate($input);
		}
		catch(ValidationException $e)
		{
			Session::flash('administrator.records.create.error', $e->getMessage());
			return Redirect::back();
		}

		$user = User::find($input['user_id']);
		$record = new Record(
			array_merge($input, [
				'first_name'		=> $user->profile->first_name,
				'middle_name'		=> $user->profile->middle_name,
				'last_name'			=> $user->profile->last_name,
				'full_name'			=> $user->profile->full_name
			])
		);
		$record->save();

		$message = 'Success creating a record!';
		Session::flash('administrator.records.create.success', $message);
		return Redirect::route('dashboard.admin.records.index');
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
