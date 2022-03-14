<?php

namespace Tray\Services\Concerns;

use Tray\Entities\Entity;
use Tray\Services\Contracts\IResource;

/**
 * @mixin IResource
 */
trait Findable
{
    /**
     * Finds the resource with the given id.
     *
     * @param int|string $id
     * @return Entity
     */
    public function find($id): Entity
    {
        $response = $this->service
            ->getClient()
            ->getRequest()
            ->get("{$this->getApiUri()}/$id");

        return $this->makeResponseFormatter($response)->toEntity();
    }
}
