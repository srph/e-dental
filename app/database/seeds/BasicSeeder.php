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
				'email'		=> $x . '@yahoo.com',
				'is_admin'	=> $i == 1 ? 1 : 0
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
				'birthdate'		=> date('Y-m-d'),
				'contact_no'	=> $this->f->phoneNumber
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
				'service_id'	=> ($i % 4) + 1,
				'schedule_id'	=> !($i % 2) ? 0 : $i / 2,
				'first_name'	=> $profile->first_name,
				'middle_name'	=> $profile->middle_name,
				'last_name'		=> $profile->last_name,
				'full_name'		=> $profile->full_name
			]);
		}
	}

	private function schedules($limit = 25)
	{
		$db = DB::table('schedules');
		$db->truncate();

		for ( $i = 1; $i <= $limit; $i++)
		{
			$x = ($i % 10) + 1;

			$db->insert([
				'id'			=> $i,
				'user_id'		=> ($i % 3) + 1,
				'appointed_at'	=> date('Y-m-d', strtotime(date('Y-m-d') . " + {$x} days")),
				'created_at'	=> date('Y-m-d')
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
				'name'	=> ['Cleaning', 'Check-up', 'Surgery', 'Pedriatics', 'Orthodontics', 'Orafacial'][($i % $limit)]
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
