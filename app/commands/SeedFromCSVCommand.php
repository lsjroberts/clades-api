<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class SeedFromCSVCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'db:seed:csv';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Seed the database from a csv file';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		$path = $this->option('path');
		$table = $this->option('table');

		if (! $path) $this->error('--path is required');
		if (! $table) $this->error('--table is required');

		if (! $path or ! $table) exit;

		$path = __DIR__ . '../../' . $path;

		if (File::isFile($path))
		{
			$handle = fopen($path, 'r');
			$columns = null;
			while ($row = fgetcsv($handle) !== false)
			{
				if (! $columns)
				{
					$columns = $row;
				}
				else
				{
					$rows[] = array_combine($columns, $row);
				}
			}
			fclose($handle);
		}

		DB::table($table)->insert($rows);
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array(

		);
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return array(
			array('path', 'p', InputOption::VALUE_REQUIRED, 'Path to the csv file', null),
			array('table', 't', InputOption::VALUE_REQUIRED, 'Table to populate', null)
		);
	}

}
