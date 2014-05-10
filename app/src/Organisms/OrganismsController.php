<?php namespace Clades\Organisms\OrganismsController;

use Clades\ApiController;
use Clades\Transformer\OrganismTransformer;

class OrganismsController extends ApiController
{
    public function index()
    {
        $organisms = Organism::take(10)->get();

        return $this->respondWithCollection($organisms, new OrganismTransformer);
    }

    public function create()
    {

    }

    public function show($id)
    {
        $organism = Organism::find($id);

        if (! $organism)
        {
            return $this->errorNotFound(sprintf('An organism with id %s does not exist', $id));
        }

        return $this->responseWithItem($organism, new OrganismTransformer);
    }

    public function update()
    {

    }

    public function delete()
    {
        $clade = Organism::findOrFail($id);

        $clade->delete();
    }

}