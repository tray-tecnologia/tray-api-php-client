<?php

namespace Tray\Services\Catalog;

use Tray\Entities\Catalog\Product;
use Tray\Services\Concerns;
use Tray\Services\Contracts\IResource;

/**
 * @method Product find($id)
 */
class ProductResource extends IResource
{
    use Concerns\Paginable;
    use Concerns\Findable;
    use Concerns\Storable;
    use Concerns\Updatable;
    use Concerns\Deletable;

    /**
     * @inheritDoc
     */
    protected function getApiUri(): string
    {
        return '/products';
    }

    /**
     * @inheritDoc
     */
    protected function getEntityClass(): string
    {
        return Product::class;
    }
}
