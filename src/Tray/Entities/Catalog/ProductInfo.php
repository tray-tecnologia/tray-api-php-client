<?php

namespace Tray\Entities\Catalog;

use Tray\Entities\Entity;

/**
 * @property  int       $id
 * @property  string    $display_value
 * @property  string    $type
 * @property  string    $name
 * @property  int       $add_total
 * @property  int       $info_id
 * @property  int       $active
 * @property  float     $value
 * @property  int       $required
 */
class ProductInfo extends Entity
{
    protected $casts = [
        'id'        => 'integer',
        'add_total' => 'integer',
        'info_id'   => 'integer',
        'active'    => 'integer',
        'required'  => 'integer',
        'value'     => 'float',
    ];
}
