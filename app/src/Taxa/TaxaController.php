<?php namespace Clades\Taxa;

use Input;
use Clades\ApiController;
use Clades\Transformer\TaxonTransformer;

class TaxaController extends ApiController
{
    public $showView = 'taxa.show';

    public function index()
    {
        if (! Input::has('q'))
        {
            return $this->errorWrongArgs("You must provide search keywords to the 'q' parameter.");
        }

        $taxa = Taxon::query()->byKeywords(Input::get('q'));

        if (Input::has('ranks') and Input::get('ranks') == 'major')
        {
            $taxa->onlyMajorRanks();
        }

        $taxa = $taxa->get();

        return $this->respondWithCollection($taxa, new TaxonTransformer);
    }

    public function create()
    {

    }

    public function show($id)
    {
        $taxon = Taxon::find($id);

        if (! $taxon)
        {
            return $this->errorNotFound(sprintf('A taxon with id %s does not exist', $id));
        }

        return $this->respondWithItem($taxon, new TaxonTransformer);
    }

}