<?php

namespace Tray\Client\Http;

use Tray\Client\Contracts\Http\IResponse;
use Tray\Client\Contracts\Http\IResponseFormatter;
use Tray\Client\Exception\ServerException;
use Tray\Entities\Contracts\IEntity;
use Tray\Entities\Entity;
use Tray\Pagination\Contracts\IPaginator;
use Tray\Pagination\Paginator;
use Tray\Support\Contracts\ICollection;
use Tray\Support\Contracts\IHydrator;
use Tray\Support\Collection;

/**
 * @phpstan-import-type EntityClass from IResponseFormatter
 * @phpstan-import-type CollectionClass from IResponseFormatter
 * @phpstan-import-type PaginatorClass from IResponseFormatter
 * @phpstan-type        Options array{entity:EntityClass,collection:CollectionClass,paginator:PaginatorClass}
 */
class ResponseFormatter implements IResponseFormatter
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
     * @var IHydrator $entityHydrator
     */
    protected $entityHydrator;

    /**
     * The instance of the collection hydrator.
     *
     * @var IHydrator $collectionHydrator
     */
    protected $collectionHydrator;

    /**
     * The entity class.
     *
     * @var class-string<IEntity> $entityClass
     */
    protected $entityClass = Entity::class;

    /**
     * The collection class.
     *
     * @var class-string<ICollection> $collectionClass
     */
    protected $collectionClass = Collection::class;

    /**
     * The paginator class.
     *
     * @var class-string<IPaginator> $paginatorClass
     */
    protected $paginatorClass = Paginator::class;

    /**
     * @inheritDoc
     */
    public function __construct(
        IResponse $response,
        IHydrator $entityHydrator,
        IHydrator $collectionHydrator,
        array $options = []
    ) {
        $this->response           = $response;
        $this->entityHydrator     = $entityHydrator;
        $this->collectionHydrator = $collectionHydrator;

        if (isset($options['entity']) && is_a($options['entity'], IEntity::class)) {
            $this->entityClass = $options['entity'];
        }

        if (isset($options['collection']) && is_a($options['collection'], ICollection::class)) {
            $this->collectionClass = $options['collection'];
        }

        if (isset($options['paginator']) && is_a($options['paginator'], IPaginator::class)) {
            $this->paginatorClass = $options['paginator'];
        }
    }

    /**
     * Returns the current options.
     *
     * @return array
     */
    protected function getCurrentOptions(): array
    {
        return [
            'entity'     => $this->entityClass,
            'collection' => $this->collectionClass,
            'paginator'  => $this->paginatorClass,
        ];
    }

    /**
     * @inheritDoc
     */
    public function withPaginator(string $paginator): IResponseFormatter
    {
        $options = $this->getCurrentOptions();
        $options['paginator'] = $paginator;

        return new static($this->response, $this->entityHydrator, $this->collectionHydrator, $options);
    }

    /**
     * @inheritDoc
     */
    public function withCollection(string $collection): IResponseFormatter
    {
        $options = $this->getCurrentOptions();
        $options['collection'] = $collection;

        return new static($this->response, $this->entityHydrator, $this->collectionHydrator, $options);
    }

    /**
     * @inheritDoc
     */
    public function withEntity(string $entity): IResponseFormatter
    {
        $options = $this->getCurrentOptions();
        $options['entity'] = $entity;

        return new static($this->response, $this->entityHydrator, $this->collectionHydrator, $options);
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

        $this->collectionHydrator->hydrate($contents, $collection);

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
    private function makeEntity(array $attributes): IEntity
    {
        if (is_a($this->entityClass, IEntity::class)) {
            throw new ServerException('The option["entity"] must be an instance of IEntity');
        }

        /** @var IEntity $entity */
        $entity = new $this->entityClass();
        $this->entityHydrator->hydrate($attributes, $entity);

        return $entity;
    }

    /**
     * Makes a new collection instance.
     *
     * @return ICollection
     * @throws ServerException
     */
    private function makeCollection(): ICollection
    {
        if (is_a($this->collectionClass, ICollection::class)) {
            throw new ServerException('The option["collection"] must be an instance of ICollection');
        }

        return new $this->collectionClass();
    }

    /**
     * Makes a new paginator instance.
     *
     * @param ICollection $items
     * @param array $paging
     * @return IPaginator
     * @throws ServerException
     */
    private function makePaginator(ICollection $items, array $paging): IPaginator
    {
        if (is_a($this->paginatorClass, IPaginator::class)) {
            throw new ServerException('The option["paginator"] must be an instance of IPaginator');
        }

        return new $this->paginatorClass($items, $paging);
    }
}
