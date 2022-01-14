<?php

namespace Tray\Client\Contracts\Http;

use Tray\Entities\Contracts\IEntity;
use Tray\Pagination\Contracts\IPaginator;
use Tray\Support\Contracts\ICollection;

/**
 * @phpstan-type EntityClass class-string<IEntity>
 * @phpstan-type CollectionClass class-string<ICollection>
 * @phpstan-type PaginatorClass class-string<IPaginator>
 * @phpstan-type OptionalOptions array{entity?:EntityClass,collection?:CollectionClass,paginator?:PaginatorClass}
 */
interface IResponseFormatter
{
    /**
     * IResponseFormatter's constructor.
     *
     * @param IResponse $response
     * @param OptionalOptions $options
     */
    public function __construct(IResponse $response, array $options = []);

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
     * @param class-string<IEntity> $entity
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
     * @return IEntity
     */
    public function toEntity(): IEntity;
}
