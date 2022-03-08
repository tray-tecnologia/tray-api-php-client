<?php

namespace Tray\Client\Contracts\Http;

use Tray\Entities\Entity;
use Tray\Pagination\Contracts\IPaginator;
use Tray\Support\Contracts\ICollection;
use Tray\Support\Contracts\IHydrator;

/**
 * @phpstan-type CollectionClass class-string<ICollection>
 * @phpstan-type PaginatorClass class-string<IPaginator>
 * @phpstan-type Options array{collection?:CollectionClass,paginator?:PaginatorClass}
 */
interface IResponseFormatter
{
    /**
     * IResponseFormatter's constructor.
     *
     * @param IResponse              $response
     * @param class-string<Entity>  $entityClass
     * @param IHydrator              $entityHydrator
     * @param IHydrator              $collectionHydrator
     * @param Options                $options
     */
    public function __construct(
        IResponse $response,
        string $entityClass,
        IHydrator $entityHydrator,
        IHydrator $collectionHydrator,
        array $options = []
    );

    /**
     * Creates a new response instance with the given entity class.
     *
     * @param class-string<IPaginator> $paginator
     *
     * @return IResponseFormatter
     */
    public function withPaginator(string $paginator): IResponseFormatter;

    /**
     * Creates a new response instance with the given entity class.
     *
     * @param class-string<ICollection> $collection
     *
     * @return IResponseFormatter
     */
    public function withCollection(string $collection): IResponseFormatter;

    /**
     * Creates a new response instance with the given entity class.
     *
     * @param class-string<Entity> $entity
     *
     * @return IResponseFormatter
     */
    public function withEntity(string $entity): IResponseFormatter;

    /**
     * Transforma os dados fornecidos em dados paginados.
     *
     * @return IPaginator
     */
    public function toPaginator(): IPaginator;

    /**
     * Transforma os itens em uma coleção de entidades.
     *
     * @return ICollection
     */
    public function toCollection(): ICollection;

    /**
     * Transforma o item fornecido em uma entidade.
     *
     * @return Entity
     */
    public function toEntity(): Entity;
}
