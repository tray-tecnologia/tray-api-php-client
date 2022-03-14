<?php

namespace Tray\Entities\Catalog;

use Tray\Entities\Entity;

/**
 * @property  int     $id
 * @property  string  $brand
 * @property  string  $slug
 */
class Brand extends Entity
{
    /**
     * @inheritDoc
     */
    protected $casts = [
        'id' => 'integer',
    ];
}
