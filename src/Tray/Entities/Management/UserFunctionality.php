<?php

namespace Tray\Entities\Management;

use Tray\Entities\Entity;

/**
 * @property boolean $edit_order_products
 * @property boolean $edit_order_discounts
 * @property boolean $edit_order_taxes
 * @property boolean $edit_order_shippings
 * @property boolean $edit_order_payments
 * @property boolean $edit_order_shipping_codes
 * @property boolean $edit_order_status
 */
class UserFunctionality extends Entity
{
    /**
     * @inheritDoc
     */
    protected $casts = [
        'edit_order_products' => 'boolean',
        'edit_order_discounts' => 'boolean',
        'edit_order_taxes' => 'boolean',
        'edit_order_shippings' => 'boolean',
        'edit_order_payments' => 'boolean',
        'edit_order_shipping_codes' => 'boolean',
        'edit_order_status' => 'boolean'
    ];
}
