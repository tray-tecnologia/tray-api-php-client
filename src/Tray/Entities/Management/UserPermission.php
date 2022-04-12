<?php

namespace Tray\Entities\Management;

use Tray\Entities\Entity;

/**
 * @property boolean $view
 * @property boolean $edit
 * @property boolean $delete
 * @property boolean $delete
 * @property boolean $export
 */
class UserPermission extends Entity
{
    /**
     * @inheritDoc
     */
    protected $casts = [
        'view' => 'boolean',
        'edit' => 'boolean',
        'add' => 'boolean',
        'delete' => 'boolean',
        'export' => 'boolean'
    ];
}
