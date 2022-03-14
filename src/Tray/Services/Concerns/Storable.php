<?php

namespace Tray\Services\Concerns;

use Tray\Client\Contracts\Http\IResponse;
use Tray\Services\Contracts\IResource;

/**
 * @mixin IResource
 */
trait Storable
{
    /**
     * Creates a new resource with the given attributes.
     *
     * @param array $attributes
     * @return int|string
     */
    public function store(array $attributes)
    {
        $entityName = $this->getEntityName();
        if ($entityName) {
            $attributes = [$entityName => $attributes];
        }

        $response = $this->service
            ->getClient()
            ->getRequest()
            ->post($this->getApiUri(), [], $attributes);

        return $this->getResourceId($response);
    }

    /**
     * Returns the resource id from the response given.
     *
     * @param IResponse $response
     * @return mixed
     */
    private function getResourceId(IResponse $response)
    {
        $contents = $response->getContents();
        return $contents['id'] ?? $contents;
    }
}
