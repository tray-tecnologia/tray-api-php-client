<?php

namespace Tray\Client\Contracts\Http;

use Psr\Http\Message\ResponseInterface;

interface IResponse
{
    /**
     * IResponse's constructor.
     *
     * @param ResponseInterface $response
     */
    public function __construct(ResponseInterface $response);

    /**
     * Retorna a resposta sem tratamento.
     *
     * @return array
     */
    public function getContents(): array;
}
