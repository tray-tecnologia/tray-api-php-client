<?php

namespace Tests\Unit;

use Tray\Client\Http\ResponseFormatter;
use Tray\Support\CollectionHydrator;
use Tray\Support\Contracts\IHydrator;
use Tray\Support\EntityHydrator;

class TestResponseFormatter extends ResponseFormatter
{
    protected $entityClass = ProductEntity::class;

    /**
     * @inheritDoc
     */
    protected function makeEntityHydrator(): IHydrator
    {
        return new EntityHydrator('Product');
    }

    /**
     * @inheritDoc
     */
    protected function makeCollectionHydrator(): IHydrator
    {
        return new CollectionHydrator('Products');
    }
}
