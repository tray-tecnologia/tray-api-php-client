<?php

namespace Tray\Services\Sales;

use Tray\Entities\Sales\CustomerAddress;
use Tray\Services\Concerns;
use Tray\Services\Contracts\IResource;

/**
 * @method CustomerAddress find($id)
 */
class CustomerAddressResource extends IResource
{
    use Concerns\Paginable;
    use Concerns\Findable;
    use Concerns\Storable;
    use Concerns\Deletable;

    /**
     * @inheritDoc
     */
    protected function getApiUri(): string
    {
        return '/customers/addresses';
    }

    /**
     * @inheritDoc
     */
    protected function getEntityClass(): string
    {
        return CustomerAddress::class;
    }
}
