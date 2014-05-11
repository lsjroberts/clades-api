<?php

use Clades\Taxa\Taxon;
use Faker\Factory as Faker;
use Clades\Organisms\Organism;

class OrganismsTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

        $leaves = Taxon::allLeaves()->get();

        foreach(range(1, 10) as $index)
        {
            $scientificName = ucwords(implode(' ', $faker->words(2)));

            $organism = Organism::create([
                'scientific_name' => $scientificName,
                'common_name' => ucwords($faker->word),
                'description' => $faker->paragraph(3),
                'url' => 'http://wikipedia.org/' . str_replace(' ', '_', $scientificName),
                'taxon_id' => $leaves->random()->id,
            ]);
        }
	}

}