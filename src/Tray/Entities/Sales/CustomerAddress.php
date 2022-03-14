<?php

namespace Tray\Entities\Sales;

use Tray\Entities\Entity;

/**
 * @property  int     $id
 * @property  int     $customer_id
 * @property  string  $description
 * @property  string  $zip_code
 * @property  string  $address
 * @property  int     $number
 * @property  string  $complement
 * @property  string  $neighborhood
 * @property  string  $city
 * @property  string  $state
 * @property  string  $country
 * @property  int     $active           0 = Endereço indisponível | 1 = Endereço disponível
 * @property  int     $not_list
 * @property  string  $recipient
 * @property  int     $type             0 = Endereço de cobrança | 1 = Endereço de entrega,
 * @property  int     $type_delivery
 */
class CustomerAddress extends Entity
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
