<?php

namespace Tray\Contracts\Http;

use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Support\Collection;

interface IResponse
{
    const ERRORS = [
        400 => 'Bad Request',
        401 => 'Unauthorized',
        403 => 'Forbidden',
        404 => 'Not Found',
        405 => 'Method Not Allowed',
        406 => 'Not Acceptable',
        422 => 'Unprocessable Entity',
        429 => 'Too Many Requests',
    ];

    const FAILURES = [
        500 => 'Internal Server Error',
        501 => 'Not Implemented',
        503 => 'Service Unavailable',
    ];

    /**
     * ResultTransformer constructor.
     *
     * @param mixed $content
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
     * @return Paginator
     */
    public function toPaginator(): Paginator;

    /**
     * Transforma os itens em uma coleção de entidades.
     *
     * @return Collection
     */
    public function toCollection(): Collection;

    /**
     * Transforma o item fornecido em uma entidade.
     *
     * @return Entity
     */
    public function toEntity(): Entity;
}
