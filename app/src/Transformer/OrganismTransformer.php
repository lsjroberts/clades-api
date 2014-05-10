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
            'classification' => $organism->classification,
            'name' => $organism->name,
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
                    'rel' => 'parent',
                    'uri' => URL::route('organisms.show', [
                        'id' => $organism->parent_id
                    ])
                ],
                [
                    'rel' => 'clade',
                    'uri' => URL::route('clades.show', [
                        'organismId' => $organism->id
                    ])
                ]
            ]
        ];
    }

}