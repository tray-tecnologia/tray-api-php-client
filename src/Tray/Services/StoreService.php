<?php

namespace Tray\Services;

use Tray\Services\Contracts\IService;

/**
 * @property  Catalog\CategoryResource  $category
 * @property  Catalog\BrandResource     $brand
 * @property  Catalog\ProductResource   $product
 * @property  Management\StoreResource  $store
 * @property  Management\UserResource   $user
 */
class StoreService extends IService
{
    /**
     * @inheritdoc
     */
    protected $bindings = [
        'category' =>  Catalog\CategoryResource::class,
        'brand'    =>  Catalog\BrandResource::class,
        'product'  =>  Catalog\ProductResource::class,
        'store'    =>  Management\StoreResource::class,
        'user'     =>  Management\UserResource::class,
    ];
}
