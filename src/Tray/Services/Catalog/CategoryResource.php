<?php

namespace Tray\Services\Catalog;

use Tray\Entities\Catalog\Category;
use Tray\Services\Concerns;
use Tray\Services\Contracts\IResource;

/**
 * @method Category find($id)
 */
class CategoryResource extends IResource
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
        return '/categories';
    }

    /**
     * @inheritDoc
     */
    protected function getEntityClass(): string
    {
        return Category::class;
    }
}
