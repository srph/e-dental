<?php

use Faker\Factory as Faker;

class BasicSeeder extends Seeder {

	public function __construct()
	{
		$this->f = Faker::create();
	}

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$this->users();
		$this->records();
		$this->schedules();
		$this->doctors();
		$this->services();
	}

	private function users($limit = 3)
	{
		$db = DB::table('users');
		$pr = DB::table('profiles');

		$db->truncate();
		$pr->truncate();

		for ( $i = 1; $i <= $limit; $i++ )
		{
			$x = 'edms' . $i;

			$db->insert([
				'id'		=> $i,
				'username'	=> $x,
				'password'	=> Hash::make('yolo'),
				'email'		=> $x . '@yahoo.com'
			]);

			$fn = $this->f->firstName;
			$mn = $this->f->lastName;
			$ln = $this->f->lastName;
			$full = "{$fn} {$mn} {$ln}";

			$pr->insert([
				'id'			=> $i,
				'user_id'		=> $i,
				'first_name'	=> $fn,
				'middle_name'	=> $mn,
				'last_name'		=> $ln,
				'full_name'		=> $full,
				'address'		=> $this->f->address,
				'birthdate'		=> date('Y-m-d')
			]);
		}
	}

	private function records($limit = 50)
	{
		$db = DB::table('records');
		$db->truncate();

		$users = User::all();

		for ( $i = 1; $i <= $limit; $i++)
		{
			$profile = $users[$i % 3]->profile;

			$db->insert([
				'id'			=> $i,
				'user_id'		=> ($i % 3) + 1,
				'doctor_id'		=> ($i % 3) + 1,
				'first_name'	=> $profile->first_name,
				'middle_name'	=> $profile->middle_name,
				'last_name'		=> $profile->last_name,
				'full_name'		=> $profile->full_name,
				'service_id'	=> ($i % 4) + 1,
			]);
		}
	}

	private function schedules($limit = 25)
	{
		$db = DB::table('schedules');
		$db->truncate();

		for ( $i = 1; $i <= $limit; $i++)
		{
			$db->insert([
				'id'			=> $i,
				'user_id'		=> ($i % 3) + 1,
				'appointed_at'	=> date('Y-m-d')
			]);
		}
	}

	private function services($limit = 5)
	{
		$db = DB::table('services');
		$db->truncate();

		for( $i = 1; $i <= $limit; $i++ )
		{
			$db->insert([
				'id'	=> $i,
				'name'	=> "{$this->f->firstName} {$this->f->lastName}"
			]);
		}
	}

	private function doctors($limit = 3)
	{
		$db = DB::table('doctors');
		$db->truncate();

		for ( $i = 1; $i <= $limit; $i++ )
		{
			$db->insert([
				'id'		=> $i,
				'name'		=> "{$this->f->firstName} {$this->f->lastName}"
			]);
		}
	}
}
