<?php

namespace Tray\Services;

use Tray\Services\Contracts\IService;

/**
 * @property Catalog\CategoryResource $category
 * @property Catalog\BrandResource    $brand
 * @property Catalog\ProductResource  $partner
 * @property Catalog\ProductResource  $payment
 * @property Catalog\ProductResource  $product
 * @property Catalog\CategoryResource $order
 * @property Catalog\CategoryResource $orderInvoice
 * @property Catalog\CategoryResource $orderStatus
 * @property Catalog\BrandResource    $customer
 * @property Catalog\ProductResource  $customerAddress
 * @property Catalog\ProductResource  $customerAttribute
 */
class StoreService extends IService
{
    /**
     * @inheritdoc
     */
    protected $bindings = [
        'category'         => Catalog\CategoryResource::class,
        'brand'            => Catalog\BrandResource::class,
        'product'          => Catalog\ProductResource::class,
        'order'            => Catalog\CategoryResource::class,
        'customer'         => Catalog\BrandResource::class,
        'customerAddress'  => Catalog\ProductResource::class,
    ];
}
