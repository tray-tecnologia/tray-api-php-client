<?php

namespace Tray\Client\Contracts\Http;

use Tray\Entities\Contracts\IEntity;
use Tray\Pagination\Contracts\IPaginator;
use Tray\Support\Contracts\ICollection;

interface IResponse
{
    public const ERRORS = [
        400 => 'Bad Request',
        401 => 'Unauthorized',
        403 => 'Forbidden',
        404 => 'Not Found',
        405 => 'Method Not Allowed',
        406 => 'Not Acceptable',
        422 => 'Unprocessable Entity',
        429 => 'Too Many Requests',
    ];

    public const FAILURES = [
        500 => 'Internal Server Error',
        501 => 'Not Implemented',
        503 => 'Service Unavailable',
    ];

    /**
     * ResultTransformer constructor.
     *
     * @param mixed  $content
     * @param string $entityClass
     */
    public function __construct($content, string $entityClass);

    /**
     * Retorna a resposta sem tratamento.
     *
     * @return mixed
     */
    public function getContent();

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
