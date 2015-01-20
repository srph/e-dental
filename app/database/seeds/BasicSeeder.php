<?php

class BasicSeeder extends Seeder {

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

	private function users()
	{
		$db = DB::table('users');
		$db->truncate();
		$db->insert()
	}

	private function records()
	{
		$db = DB::table('records');
		$db->truncate();
		$db->insert()
	}

	private function schedules()
	{
		$db = DB::table('schedules');
		$db->truncate();
		$db->insert()
	}

	private function services()
	{
		$db = DB::table('services');
		$db->truncate();
		$db->insert()
	}

	private function doctors()
	{
		$db = DB::table('doctors');
		$db->truncate();
		$db->insert()
	}
}
