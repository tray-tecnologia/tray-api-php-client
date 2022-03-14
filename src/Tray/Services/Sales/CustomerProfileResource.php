<?php

namespace Tray\Services\Sales;

use Tray\Entities\Sales\CustomerProfile;
use Tray\Services\Concerns;
use Tray\Services\Contracts\IResource;

/**
 * @method CustomerProfile find($id)
 */
class CustomerProfileResource extends IResource
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
        return '/customers/profiles';
    }

    /**
     * @inheritDoc
     */
    protected function getEntityClass(): string
    {
        return CustomerProfile::class;
    }
}
