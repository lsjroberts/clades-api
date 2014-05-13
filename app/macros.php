<?php

use Clades\Taxa\Taxon;

HTML::macro('taxon', function(Taxon $taxon)
{
    return View::make('macros.taxon', [
        'taxon' => $taxon,
    ])->render();
});