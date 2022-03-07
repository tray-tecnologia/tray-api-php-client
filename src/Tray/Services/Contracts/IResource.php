<?php

namespace Tray\Services\Contracts;

use Tray\Client\Contracts\Http\IResponse;
use Tray\Client\Contracts\Http\IResponseFormatter;
use Tray\Client\Http\ResponseFormatter;
use Tray\Support\CollectionHydrator;
use Tray\Support\Contracts\IHydrator;
use Tray\Support\EntityHydrator;

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

    /**
     * Returns the envelope used by the entity hydrator.
     *
     * @return string
     */
    abstract protected function getEntityEnvelope(): string;

    /**
     * Returns the envelope used by the collection hydrator.
     *
     * @return string
     */
    abstract protected function getCollectionEnvelope(): string;

    /**
     * Makes a new response formatter instance.
     *
     * @param IResponse $response
     * @return IResponseFormatter
     */
    protected function makeResponseFormatter(IResponse $response): IResponseFormatter
    {
        return new ResponseFormatter($response, $this->makeEntityHydrator(), $this->makeCollectionHydrator());
    }

    /**
     * Returns the entity's hydrator.
     *
     * @return IHydrator
     */
    protected function makeEntityHydrator(): IHydrator
    {
        return new EntityHydrator($this->getEntityEnvelope());
    }

    /**
     * Returns the collection's hydrator.
     *
     * @return IHydrator
     */
    protected function makeCollectionHydrator(): IHydrator
    {
        return new CollectionHydrator($this->getCollectionEnvelope());
    }
}
