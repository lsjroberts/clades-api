<?php

use Clades\Taxa\Taxon;
use Faker\Factory as Faker;

class TaxaTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		foreach(range(1, 10) as $index)
		{
            $name = ucwords($faker->word);
            $taxa = Taxon::create([
                'name' => $name,
                'rank' => $faker->randomElement(['Domain', 'Kingdom', 'Phylum', 'Class', 'Order', 'Family', 'Genus', 'Species']),
                'url' => 'http://wikipedia.org/' . str_replace(' ', '_', $name),
            ]);

            if ($index > 1)
            {
                $taxa->makeChildOf(rand(1, $index - 1));
                $taxa->save();
            }
		}
	}

}