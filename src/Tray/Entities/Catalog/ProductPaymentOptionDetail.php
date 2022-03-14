<?php

namespace Tray\Entities\Catalog;

use Tray\Entities\Entity;

/**
 * @property  string  $display_name
 * @property  string  $type               The payment method. Example: 'credit_card'
 * @property  string  $plots
 * @property  float   $value
 * @property  string  $tax
 */
class ProductPaymentOptionDetail extends Entity
{
    /**
     * @inheritDoc
     */
    protected $casts = [
        'value' => 'float',
    ];
}
