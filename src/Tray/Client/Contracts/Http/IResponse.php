<?php

namespace Tray\Client\Contracts\Http;

use Psr\Http\Message\ResponseInterface;
//use Tray\Entities\Contracts\IEntity;
//use Tray\Pagination\Contracts\IPaginator;
//use Tray\Support\Contracts\ICollection;

interface IResponse
{
    /**
     * IResponse's constructor.
     *
     * @param ResponseInterface $response
     * @param array $options
     */
    public function __construct(ResponseInterface $response, array $options);

    /**
     * Retorna a resposta sem tratamento.
     *
     * @return mixed
     */
    public function getContents();

//    /**
//     * Creates a new response instance with the given entity class.
//     *
//     * @param class-string<IPaginator> $paginatorClass
//     *
//     * @return IResponse
//     */
//    public function withPaginator(string $paginatorClass): IResponse;
//
//    /**
//     * Creates a new response instance with the given entity class.
//     *
//     * @param class-string<ICollection> $collectionClass
//     *
//     * @return IResponse
//     */
//    public function withCollection(string $collectionClass): IResponse;
//
//    /**
//     * Creates a new response instance with the given entity class.
//     *
//     * @param class-string<IEntity> $entityClass
//     *
//     * @return IResponse
//     */
//    public function withEntity(string $entityClass): IResponse;
//
//    /**
//     * Transforma os dados fornecidos em dados paginados.
//     *
//     * @return IPaginator
//     */
//    public function toPaginator(): IPaginator;
//
//    /**
//     * Transforma os itens em uma coleção de entidades.
//     *
//     * @return ICollection
//     */
//    public function toCollection(): ICollection;
//
//    /**
//     * Transforma o item fornecido em uma entidade.
//     *
//     * @return IEntity
//     */
//    public function toEntity(): IEntity;
}
