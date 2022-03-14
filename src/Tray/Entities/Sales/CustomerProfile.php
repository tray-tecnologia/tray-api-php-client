<?php

namespace Tray\Entities\Sales;

use Tray\Entities\Entity;

/**
 * @property  int     $id
 * @property  int     $price_list_id
 * @property  int     $theme_id
 * @property  string  $name
 * @property  string  $approves_registration
 * @property  int     $show_price
 * @property  string  $status
 *
 * @see https://developers.tray.com.br/#consultar-dados-do-endereco-de-um-cliente-get
 */
class CustomerProfile extends Entity
{
    /**
     * @inheritdoc
     */
    protected $casts = [
        'id'            => 'int',
        'number'        => 'int',
        'not_list'      => 'int',
        'type_delivery' => 'int',
    ];
}
