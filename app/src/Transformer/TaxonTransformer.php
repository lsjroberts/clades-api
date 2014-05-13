<?php namespace Clades\Transformer;

use URL;
use Input;
use Clades\Taxa\Taxon;
use League\Fractal\TransformerAbstract;

class TaxonTransformer extends TransformerAbstract
{
    public $availableEmbeds = [
        'taxonomy',
        'source',
    ];

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

        return [
            'id' => (int) $taxon->id,
            'name' => $taxon->name,
            'rank' => $taxon->rank,
            'url' => $taxon->url,
            'links' => $links,
        ];
    }

    public function embedTaxonomy(Taxon $taxon)
    {
        $ancestors = $taxon->ancestors();

        if (Input::has('ranks') and Input::get('ranks') == 'major')
        {
            $ancestors->onlyMajorRanks();
        }

        return $this->collection($ancestors->get(), new TaxonTransformer);
    }

    public function embedSource(Taxon $taxon)
    {
        if ($taxon->source)
        {
            return $this->item($taxon->source, new SourceTransformer);
        }
    }

}