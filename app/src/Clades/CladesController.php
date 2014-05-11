<?php namespace Clades\Clades;

use Input;
use Clades\ApiController;
use Clades\Transformer\CladeTransformer;

class CladesController extends ApiController
{
    public function show($organismId)
    {
        $organism = Organism::find($id);

        if (! $organism)
        {
            return $this->errorNotFound(sprintf('An organism with id %s does not exist', $id));
        }

        return $this->respondWithItem($organism, new OrganismTransformer);
    }

}