<?php

namespace Tray\Entities\Management;

use Tray\Entities\Entity;

/**
 * @property string   $cpf
 * @property boolean  $two_factor_enabled
 * @property int      $id
 * @property string   $full_name
 * @property string   $name
 * @property string   $email
 * @property boolean  $main_user
 * @property string   $image
 * @property boolean  $active
 * @property string   $password_update_date
 * @property string   $password_update_ip
 * @property string   $last_login
 */
class User extends Entity
{
    /**
     * @inheritDoc
     */
    protected $casts = [
        'id' => 'integer',
        'main_user' => 'boolean',
        'active' => 'boolean',
        'two_factor_enabled' => 'boolean'
    ];

    /**
     * Sets the user's permissions.
     *
     * @param  mixed $values
     * @return void
     */
    public function setPermissionsAttribute($values): void
    {
        $this->attributes['Permissions'] = new Permission($values);
    }
}
