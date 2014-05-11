<?php

use Clades\Taxa\Taxon;
use Clades\Filesystem\CSV;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class CladesSearchTaxaCommand extends Command {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'clades:search:taxa';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Search taxa';

    public function fire()
    {
        $search = $this->argument('taxon');
        $descendants = $this->option('descendants');
        $tree = $this->option('tree');
        $fulltree = $this->option('fulltree');

        $taxon = Taxon::where('name', 'LIKE', $search)->first();

        if ($taxon)
        {
            if ($tree)
            {
                $this->outputTaxonTree($taxon, $fulltree);
            }
            else
            {
                $this->outputTaxon($taxon, $descendants);
            }
        }
        else
        {
            $taxa = Taxon::where('name', 'LIKE', '%' . $search);

            foreach ($taxa as $taxon)
            {
                $this->outputTaxon($taxon, $descendants);
            }
        }
    }

    public function outputTaxon($taxon, $descendants)
    {
        $this->line("");

        $this->info(sprintf("%s (%s, %s)",
            $taxon->name,
            ucwords($taxon->type),
            ($taxon->extant) ? 'Extant' : 'Extinct')
        );

        $this->line("");

        $this->comment(implode(' > ', $taxon->taxonomy()));

        if ($descendants)
        {
            $combined = [];
            foreach ($taxon->getImmediateDescendants() as $descendant)
            {
                $combined[] = $descendant->name;
            }
            $this->comment("\t< " . implode("\n\t< ", $combined));
        }
    }

    public function outputTaxonTree($taxon, $fulltree)
    {
        $root = $taxon->getRoot();

        foreach ($root->getDescendantsAndSelf() as $t)
        {
            $depth = str_repeat('  ', $t->getDepth());

            if ($t == $taxon)
            {
                $this->info($depth . '> ' . $t->name);
            }
            elseif ($t->isDescendantOf($taxon) or $t->isAncestorOf($taxon))
            {
                $this->comment($depth . '> ' . $t->name);
            }
            elseif ($fulltree)
            {
                $this->line($depth . '> ' . $t->name);
            }
        }
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return array(
            array('taxon', InputArgument::REQUIRED, 'Taxon name to search'),
        );
    }

    protected function getOptions()
    {
        return array(
            array('descendants', 'd', InputOption::VALUE_NONE, 'Show descendants'),
            array('tree', 't', InputOption::VALUE_NONE, 'Show the tree'),
            array('fulltree', 'f', InputOption::VALUE_NONE, 'Show the full tree'),
        );
    }

}