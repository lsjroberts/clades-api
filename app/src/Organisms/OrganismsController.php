<?php namespace Clades\Organisms;

use Input;
use Clades\ApiController;
use Clades\Transformer\OrganismTransformer;

class OrganismsController extends ApiController
{
    public function index()
    {
        if (! Input::has('q'))
        {
            return $this->errorWrongArgs("You must provide search keywords to the 'q' parameter.");
        }

        $organisms = Organism::query()->byKeywords(Input::get('q'))->get();

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

        return $this->respondWithItem($organism, new OrganismTransformer);
    }

    public function update()
    {

    }

    public function delete()
    {
        $organism = Organism::findOrFail($id);

        $organism->delete();
    }

}