<?php

namespace Tray\Services\Concerns;

use Tray\Services\Contracts\IResource;
use Tray\Support\Contracts\ICollection;

/**
 * @mixin IResource
 */
trait Listable
{
    /**
     * Retrieves the resource list.
     *
     * @param array $query
     * @return ICollection
     */
    public function all(array $query = []): ICollection
    {
        $response = $this->service
            ->getClient()
            ->getRequest()
            ->get($this->getApiUri(), $query);

        return $this->makeResponseFormatter($response)->toCollection();
    }
}
