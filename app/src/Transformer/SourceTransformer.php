<?php namespace Clades\Transformer;

use URL;
use Clades\Sources\Source;
use League\Fractal\TransformerAbstract;

class SourceTransformer extends TransformerAbstract
{

    /**
     * Turns this item object into a generic array.
     *
     * @param  Source $sources
     * @return array
     */
    public function transform(Source $source)
    {
        return [
            'id' => (int) $source->id,
            'author' => $source->author,
            'date' => $source->date,
            'name' => $source->name,
            'url' => $source->url,
            'links' => [
                [
                    'rel' => 'self',
                    'uri' => URL::route('sources.show', [
                        'id' => $source->id
                    ])
                ],
                [
                    'rel' => 'taxon',
                    'uri' => URL::route('taxa.query.source', [
                        'sourceId' => $source->id
                    ])
                ],
            ]
        ];
    }

}