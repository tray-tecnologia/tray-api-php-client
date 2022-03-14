<?php

namespace Tray\Services\Contracts;

use RuntimeException;
use Tray\Client\Contracts\Http\IResponse;
use Tray\Client\Contracts\Http\IResponseFormatter;
use Tray\Client\Http\ResponseFormatter;
use Tray\Entities\Entity;
use Tray\Support\CollectionHydrator;
use Tray\Support\Contracts\IHydrator;
use Tray\Support\EntityHydrator;
use Tray\Support\Str;

/**
 * @SuppressWarnings(PHPMD.StaticAccess)
 */
abstract class IResource
{
    /**
     * Service instance.
     *
     * @var IService
     */
    protected $service;

    /**
     * The envelope used by the entity hydrator.
     *
     * @var string|null
     */
    protected $entityEnvelope = null;

    /**
     * The collection used by the entity hydrator.
     *
     * @var string|null
     */
    protected $collectionEnvelope = null;

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
     * @return class-string<Entity>
     */
    abstract protected function getEntityClass(): string;

    /**
     * Returns the entity's name.
     *
     * @return string|null
     */
    final protected function getEntityName(): ?string
    {
        $fragments = explode('\\', $this->getEntityClass());
        $className = array_pop($fragments);
        $className = str_replace('Entity', '', $className);

        if (!$className) {
            return null;
        }

        return $className;
    }

    /**
     * Returns the envelope used by the entity hydrator.
     *
     * @return string
     */
    protected function getEntityEnvelope(): string
    {
        if ($this->entityEnvelope) {
            return $this->entityEnvelope;
        }

        $entityClass = $this->getEntityName();
        if (!$entityClass) {
            throw new RuntimeException('Invalid entity given');
        }

        return $entityClass;
    }

    /**
     * Returns the envelope used by the collection hydrator.
     *
     * @return string
     */
    protected function getCollectionEnvelope(): string
    {
        if ($this->collectionEnvelope) {
            return $this->collectionEnvelope;
        }

        $entityClass = $this->getEntityName();
        if (!$entityClass) {
            throw new RuntimeException('Invalid entity given');
        }

        return Str::pluralize($entityClass);
    }

    /**
     * Makes a new response formatter instance.
     *
     * @param IResponse $response
     * @return IResponseFormatter
     */
    protected function makeResponseFormatter(IResponse $response): IResponseFormatter
    {
        return new ResponseFormatter(
            $response,
            $this->getEntityClass(),
            $this->makeEntityHydrator(),
            $this->makeCollectionHydrator(),
        );
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
