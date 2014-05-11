<?php namespace Clades\Transformer;

use URL;
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
            'scientific_name' => $organism->scientific_name,
            'common_name' => $organism->common_name,
            'description' => $organism->description,
            'images' => $organism->images,
            'url' => $organism->url,
            'links' => [
                [
                    'rel' => 'self',
                    'uri' => URL::route('organisms.show', [
                        'id' => $organism->id
                    ])
                ],
                [
                    'rel' => 'taxon',
                    'uri' => URL::route('taxa.show', [
                        'id' => $organism->taxon_id
                    ])
                ],
            ]
        ];
    }

}