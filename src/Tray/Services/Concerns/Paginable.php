<?php

namespace Tray\Services\Concerns;

use Tray\Pagination\Contracts\IPaginator;
use Tray\Services\Contracts\IResource;

/**
 * @mixin IResource
 */
trait Paginable
{
    /**
     * Retrieves the resource paginated.
     *
     * @param array $query
     * @return IPaginator
     */
    public function paginate(array $query = []): IPaginator
    {
        $response = $this->service
            ->getClient()
            ->getRequest()
            ->get($this->getApiUri(), $query);

        return $this->makeResponseFormatter($response)->toPaginator();
    }
}
