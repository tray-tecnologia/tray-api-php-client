<?php

namespace Tray\Services\Contracts;

abstract class IResource
{
    /**
     * Service instance.
     *
     * @var IService
     */
    protected $service;

    /**
     * ProductResource's constructor.
     *
     * @param IService $service
     */
    public function __construct(IService $service)
    {
        $this->service = $service;
    }

    /**
     * Returns the service's base api uri.
     *
     * @return string
     */
    abstract protected function getApiUri(): string;
}
