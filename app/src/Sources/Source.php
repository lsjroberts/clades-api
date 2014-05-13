<?php namespace Clades\Sources;

use Eloquent;

/**
* Source
*/
class Source extends Eloquent
{

    /**
    * Table name.
    *
    * @var string
    */
    protected $table = 'sources';

    public function taxons()
    {
        return $this->hasMany('\Clades\Taxa\Taxon');
    }

}
