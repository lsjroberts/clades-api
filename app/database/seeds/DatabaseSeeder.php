<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		if (App::environment() === 'production')
		{
			exit('Can not run seeds on production environment');
		}

		Eloquent::unguard();

		$tables = [
			'organisms'
		];

		foreach ($tables as $table)
		{
			DB::table($table)->truncate();
		}

		$this->call('TaxaTableSeeder');
		$this->call('OrganismsTableSeeder');
	}

}
