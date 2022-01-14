<?php

namespace Tray\Client\Http;

use Tray\Client\Contracts\Http\IResponse;
use Tray\Client\Contracts\Http\IResponseFormatter;
use Tray\Client\Exception\ServerException;
use Tray\Entities\Contracts\IEntity;
use Tray\Entities\Entity;
use Tray\Pagination\Contracts\IPaginator;
use Tray\Support\Contracts\{ICollection, IHydrator};
use Tray\Pagination\Paginator;
use Tray\Support\Collection;

/**
 * @phpstan-import-type EntityClass from IResponseFormatter
 * @phpstan-import-type CollectionClass from IResponseFormatter
 * @phpstan-import-type PaginatorClass from IResponseFormatter
 * @phpstan-type        Options array{entity:EntityClass,collection:CollectionClass,paginator:PaginatorClass}
 */
abstract class ResponseFormatter implements IResponseFormatter
{
    /**
     * The response that contains the data to format.
     *
     * @var IResponse $response
     */
    protected $response;

    /**
     * The instance of the entity hydrator.
     *
     * @var IHydrator|null $entityHydrator
     */
    protected $entityHydrator = null;

    /**
     * The instance of the collection hydrator.
     *
     * @var IHydrator|null $collectionHydrator
     */
    protected $collectionHydrator = null;

    /**
     * The classes being used to formate.
     *
     * @var Options $options
     */
    protected $options = [
        'entity'     => Entity::class,
        'collection' => Collection::class,
        'paginator'  => Paginator::class,
    ];

    /**
     * @inheritDoc
     */
    public function __construct(IResponse $response, array $options = [])
    {
        $this->response = $response;

        foreach ($options as $key => $class) {
            $this->options[$key] = $class;
        }
    }

    /**
     * Makes a new instance of a entity hydrator.
     *
     * @return IHydrator
     */
    abstract protected function makeEntityHydrator(): IHydrator;

    /**
     * Makes a new instance of a collection hydrator.
     *
     * @return IHydrator
     */
    abstract protected function makeCollectionHydrator(): IHydrator;

    /**
     * Returns the instance of the entity hydrator.
     *
     * @return IHydrator
     */
    protected function getEntityHydrator(): IHydrator
    {
        if (!$this->entityHydrator) {
            $this->entityHydrator = $this->makeEntityHydrator();
        }

        return $this->entityHydrator;
    }

    /**
     * Returns the instance of the collection hydrator.
     *
     * @return IHydrator
     */
    protected function getCollectionHydrator(): IHydrator
    {
        if (!$this->collectionHydrator) {
            $this->collectionHydrator = $this->makeCollectionHydrator();
        }

        return $this->collectionHydrator;
    }

    /**
     * @inheritDoc
     */
    public function withPaginator(string $paginator): IResponseFormatter
    {
        return new static($this->response, compact('paginator'));
    }

    /**
     * @inheritDoc
     */
    public function withCollection(string $collection): IResponseFormatter
    {
        return new static($this->response, compact('collection'));
    }

    /**
     * @inheritDoc
     */
    public function withEntity(string $entity): IResponseFormatter
    {
        return new static($this->response, compact('entity'));
    }

    /**
     * @inheritDoc
     * @throws ServerException
     */
    public function toEntity(): IEntity
    {
        return $this->makeEntity($this->response->getContents());
    }

    /**
     * @inheritDoc
     * @throws ServerException
     */
    public function toCollection(): ICollection
    {
        $contents   = $this->response->getContents();
        $collection = $this->makeCollection();

        $this->makeCollectionHydrator()->hydrate($contents, $collection);

        return $collection->map(
            function ($attributes) {
                return $this->makeEntity($attributes);
            }
        );
    }

    /**
     * @inheritDoc
     * @throws ServerException
     */
    public function toPaginator(): IPaginator
    {
        $collection = $this->toCollection();
        $paging     = $this->response->getContents()['paging'] ?? [];

        return $this->makePaginator($collection, $paging);
    }

    /**
     * Makes a new entity instance.
     *
     * @param array $attributes
     * @return IEntity
     * @throws ServerException
     */
    protected function makeEntity(array $attributes): IEntity
    {
        if (is_a($this->options['entity'], IEntity::class)) {
            throw new ServerException('The option["entity"] must be an instance of IEntity');
        }

        /** @var IEntity $entity */
        $entity = new $this->options['entity']();
        $this->makeEntityHydrator()->hydrate($attributes, $entity);

        return $entity;
    }

    /**
     * Makes a new collection instance.
     *
     * @return ICollection
     * @throws ServerException
     */
    protected function makeCollection(): ICollection
    {
        if (is_a($this->options['collection'], ICollection::class)) {
            throw new ServerException('The option["collection"] must be an instance of ICollection');
        }

        return new $this->options['collection']();
    }

    /**
     * Makes a new paginator instance.
     *
     * @param ICollection $items
     * @param array $paging
     * @return IPaginator
     * @throws ServerException
     */
    protected function makePaginator(ICollection $items, array $paging): IPaginator
    {
        if (is_a($this->options['paginator'], IPaginator::class)) {
            throw new ServerException('The option["paginator"] must be an instance of IPaginator');
        }

        return new $this->options['paginator']($items, $paging);
    }
}
