<?php

namespace Tray\Services\Concerns;

use Tray\Services\Contracts\IResource;

/**
 * @mixin IResource
 */
trait Updatable
{
    /**
     * Updates the resource with the given id.
     *
     * @param int|string $id
     * @param array $attributes
     * @return bool
     */
    public function update($id, array $attributes): bool
    {
        $entityName = $this->getEntityName();
        if ($entityName) {
            $attributes = [$entityName => $attributes];
        }

        $this->service
            ->getClient()
            ->getRequest()
            ->put("{$this->getApiUri()}/$id", [], $attributes);

        return true;
    }
}
