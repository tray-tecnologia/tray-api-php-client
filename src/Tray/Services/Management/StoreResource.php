<?php

namespace Tray\Services\Management;

use Tray\Entities\Management\Store;
use Tray\Services\Contracts\IResource;

class StoreResource extends IResource
{
    /**
     * @inheritDoc
     */
    protected function getApiUri(): string
    {
        return '/info';
    }

    /**
     * @inheritDoc
     */
    protected function getEntityClass(): string
    {
        return Store::class;
    }

    /**
     * Finds the store info.
     *
     * @return Store
     */
    public function find(): Store
    {
        $response = $this->service
            ->getClient()
            ->getRequest()
            ->get("{$this->getApiUri()}");

        /** @var Store $entity */
        $entity = $this->makeResponseFormatter($response)->toEntity();
        return $entity;
    }
}
