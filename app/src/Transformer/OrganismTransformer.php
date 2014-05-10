<?php namespace Clades\Transformer;

use Clades\Organisms\Organism;
use League\Fractal\TransformerAbstract;

class OrganismTransformer extends TransformerAbstract
{

    /**
     * Turns this item object into a generic array.
     *
     * @param  Organism $organism
     * @return array
     */
    public function transform(Organism $organism)
    {
        return [
            'id' => (int) $organism->id,
            'classification' => $organism->classification,
            'name' => $organism->name,
            'description' => $organism->description,
            'images' => $organism->images,
            'url' => $organism->url,
        ];
    }

}