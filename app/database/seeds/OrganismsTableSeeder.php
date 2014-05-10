<?php

use Faker\Factory as Faker;
use Clades\Organisms\Organism;

class OrganismsTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

        foreach(range(1, 100) as $index)
        {
            $organism = Organism::create([
                'name' => ucwords($faker->word),
                'classification' => ucwords(implode(' ', $faker->words(2))),
                'description' => $faker->paragraph(3),
                'url' => $faker->url,
            ]);

            if ($index > 1)
            {
                $organism->makeChildOf(rand(1, $index - 1));
                $organism->save();
            }
        }
	}

}