<?php namespace Clades\Taxa;

use Baum\Node;
use Baum\Extensions\Eloquent\Collection as BaumCollection;

/**
* Taxon
*/
class Taxon extends Node
{
    public $majorRanks = ['domain', 'kingdom', 'phylum', 'class', 'order', 'family', 'genus', 'species'];

    /**
    * Table name.
    *
    * @var string
    */
    protected $table = 'taxa';

    /**
    * Column name which stores reference to parent's node.
    *
    * @var int
    */
    protected $parentColumn = 'parent_id';

    /**
    * Column name for the left index.
    *
    * @var int
    */
    protected $leftColumn = 'left';

    /**
    * Column name for the right index.
    *
    * @var int
    */
    protected $rightColumn = 'right';

    /**
    * Column name for the depth field.
    *
    * @var int
    */
    protected $depthColumn = 'depth';

    /**
    * With Baum, all NestedSet-related fields are guarded from mass-assignment
    * by default.
    *
    * @var array
    */
    protected $guarded = array('id', 'parent_id', 'left', 'right', 'depth');

    /**
    * Columns which restrict what we consider our Nested Set list
    *
    * @var array
    */
    protected $scoped = array();

    public function source()
    {
        return $this->belongsTo('\Clades\Sources\Source');
    }

    public function taxonomy()
    {
        $taxonomy = [];

        foreach ($this->getAncestorsAndSelf() as $taxon)
        {
            $taxonomy[] = $taxon->name;
        }

        return $taxonomy;
    }

    public function scopeByKeywords($query, $keywords)
    {
        return $query->where('name', 'LIKE', $keywords);
    }

    public function scopeOnlyMajorRanks($query)
    {
        return $query->whereIn('rank', $this->majorRanks);
    }

    public function ancestorsAndDescendants($up = 1, $down = 1)
    {
        $ancestors = $this->ancestors()->where('depth', '>=', $this->depth - $up)->get();
        $descendants = $this->descendants()->where('depth', '<=', $this->depth + $down)->get();

        $combined = (new BaumCollection)
            ->merge($ancestors)
            ->merge($descendants);

        return $combined;
    }

    public function ancestorsAndDescendantsAndSelf($up = 1, $down = 1)
    {
        $combined = $this->ancestorsAndDescendants($up, $down);

        $combined->push($this);

        return $combined;
    }

    public function ancestorsAndDescendantsAndSiblingsAndSelf($up = 1, $down = 1)
    {
        $siblings = $this->getSiblings();

        $combined = $this->ancestorsAndDescendantsAndSelf($up, $down);

        $combined = $combined->merge($siblings);

        return $combined;
    }

    public function getTree($up = 1, $down = 1, $siblings = false)
    {
        if ($siblings)
        {
            $combined = $this->ancestorsAndDescendantsAndSiblingsAndSelf($up, $down);
        }
        else
        {
            $combined = $this->ancestorsAndDescendantsAndSelf($up, $down);
        }

        return $combined->toHierarchy();
    }

}
