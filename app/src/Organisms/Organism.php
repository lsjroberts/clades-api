<?php namespace Clades\Organisms;

use Eloquent;

/**
* Organism
*/
class Organism extends Eloquent
{

    /**
    * Table name.
    *
    * @var string
    */
    protected $table = 'organisms';

    public function taxon()
    {
        return $this->belongsTo('\Clades\Taxa\Taxon', 'taxon_id');
    }

    public function scopeByKeywords($query, $keywords)
    {
        return $query
            ->where('scientific_name', '=', $keywords)
            ->orWhere('scientific_name', 'LIKE', '%' . $keywords . ' ')
            ->orWhere('common_name', '=', $keywords);
    }

}
