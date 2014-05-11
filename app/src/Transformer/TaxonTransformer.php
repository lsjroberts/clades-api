<?php namespace Clades\Transformer;

use URL;
use Clades\Taxa\Taxon;
use League\Fractal\TransformerAbstract;

class TaxonTransformer extends TransformerAbstract
{

    /**
     * Turns this item object into a generic array.
     *
     * @param  Taxon $taxon
     * @return array
     */
    public function transform(Taxon $taxon)
    {
        $links = [
            [
                'rel' => 'self',
                'uri' => URL::route('taxa.show', [
                    'id' => $taxon->id
                ])
            ]
        ];

        foreach ($taxon->getAncestors() as $ancestor)
        {
            $links[] = [
                'rel' => 'taxa.' . strtolower($ancestor->type),
                'url' => URL::route('taxa.show', [
                    'id' => $ancestor->id
                ])
            ];
        }

        return [
            'id' => (int) $taxon->id,
            'name' => $taxon->name,
            'type' => $taxon->type,
            'url' => $taxon->url,
            'links' => $links,
        ];
    }

}