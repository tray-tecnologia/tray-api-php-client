<?php

namespace Tray\Entities\Sales;

use Tray\Entities\Entity;

/**
 * @property int    $id
 * @property int    $product_id
 * @property int    $variant_id
 * @property int    $order_id
 * @property string $name
 * @property float  $price
 * @property float  $original_price
 * @property int    $quantity
 * @property string $model
 * @property string $reference
 * @property string $additional_information
*/
class ProductSold extends Entity
{
    /**
     * @inheritDoc
     */
    protected $casts = [
        'id'             => 'integer',
        'product_id'     => 'integer',
        'variant_id'     => 'integer',
        'order_id'       => 'integer',
        'price'          => 'float',
        'original_price' => 'float',
        'quantity'       => 'float',
    ];
}
