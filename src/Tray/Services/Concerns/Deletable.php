<?php

namespace Tray\Services\Concerns;

use Tray\Services\Contracts\IResource;

/**
 * @mixin IResource
 */
trait Deletable
{
    /**
     * Deletes the resource with the given id.
     *
     * @param int|string $id
     * @return bool
     */
    public function delete($id): bool
    {
        $this->service
            ->getClient()
            ->getRequest()
            ->delete("{$this->getApiUri()}/$id");

        return true;
    }
}
