<?php

use Clades\Taxa\Taxon;
use Clades\Filesystem\CSV;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class CladesImportTaxaCommand extends Command {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'clades:import:taxa';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import the taxa csv file';

    public function fire()
    {
        $rows = CSV::read(__DIR__ . '/../database/csv/taxa.csv');

        foreach ($rows as $row)
        {
            $this->info(sprintf("Creating '%s'", $row['name']));

            $taxon = Taxon::create([
                'name' => $row['name'],
                'rank' => $row['rank'],
                'extant' => ("" === $row['extant']) ? true : (bool) $row['extant'],
            ]);

            if (! empty($row['parent']))
            {
                $parent = Taxon::where('name', '=', $row['parent'])->first();
                if (! $parent) throw new InvalidArgumentException(sprintf("Taxon parent '%s' could be found", $row['parent']));
                $taxon->makeChildOf($parent->id);
                $taxon->save();
            }
        }
    }

}