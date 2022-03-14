<?php

namespace Tray\Entities\Sales;

use Tray\Entities\Entity;

/**
 * @property  int     $id
 * @property  int     $profile_customer_id
 * @property  string  $name
 * @property  string  $nickname
 * @property  string  $email
 * @property  string  $cpf
 * @property  string  $cnpj
 * @property  string  $registration_date
 * @property  string  $last_visit
 * @property  string  $gender                  0 = Masculino | 1 = Feminino
 * @property  string  $birth_date
 * @property  string  $city
 * @property  string  $state
 * @property  string  $newsletter
 * @property  string  $discount
 * @property  string  $created
 * @property  string  $modified
 */
class Customer extends Entity
{
    /**
     * @inheritdoc
     */
    protected $casts = [
      'id'                  => 'int',
      'profile_customer_id' => 'int',
    ];
}
