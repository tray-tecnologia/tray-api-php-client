<?php

namespace Tray\Entities\Management;

use Tray\Entities\Entity;

/**
 * @property int    $id
 * @property string $name
 */
class Store extends Entity
{
    /**
     * @inheritDoc
     */
    protected $casts = [
        'id' => 'integer',
    ];
}
