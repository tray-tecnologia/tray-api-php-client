<?php

namespace Tray\Services\Catalog;

use Tray\Entities\Catalog\Brand;
use Tray\Services\Concerns;
use Tray\Services\Contracts\IResource;

/**
 * @method Brand find($id)
 */
class BrandResource extends IResource
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
        return '/brands';
    }

    /**
     * @inheritDoc
     */
    protected function getEntityClass(): string
    {
        return Brand::class;
    }
}
