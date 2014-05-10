<?php namespace Clades\Organisms;

use Baum\Node;

/**
* Organism
*/
class Organism extends Node
{

  /**
   * Table name.
   *
   * @var string
   */
  protected $table = 'organisms';

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

}
