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

	/**
	 * Class constructor
	 *
	 * @param Ki\Validators\Record $validator 	Validator wharevs
	 */
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

		return $this->view('administrator.records.index', compact('records'));
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
		$data = compact('users', 'services', 'doctors');

		return $this->view('administrator.records.create', $data);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = $this->input(['user_id', 'service_id', 'doctor_id']);

		try
		{
			// Catch invalid data
			$this->validator->validate($input);
		}
		catch(ValidationException $e)
		{
			$key = 'administrator.records.create.error';

			return $this
				->flash($key, $e->getMessage() )
				->back(true);
		}

		// Fetch the user with the provided ID
		$user = User::find( $input['user_id'] );

		// Let's create the record
		$record = new Record;
		$record->user_id 		= $input['user_id'];
		$record->service_id 	= $input['service_id'];
		$record->doctor_id 		= $input['doctor_id'];
		$record->first_name		= $user->profile->first_name;
		$record->middle_name	= $user->profile->middle_name;
		$record->last_name		= $user->profile->last_name;
		$record->full_name		= $user->profile->full_name;
		$record->save();

		$key = 'administrator.records.create.success';
		$message = 'Record was successfully created!';

		return $this
			->flash($key, $message)
			->redirect('dashboard.admin.records.index');
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
