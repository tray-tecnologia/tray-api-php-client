<?php

namespace Tray\Services\Sales;

use Tray\Entities\Sales\Customer;
use Tray\Services\Concerns;
use Tray\Services\Contracts\IResource;

/**
 * @method Customer find($id)
 */
class CustomerResource extends IResource
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
        return '/customers';
    }

    /**
     * @inheritDoc
     */
    protected function getEntityClass(): string
    {
        return Customer::class;
    }
}
