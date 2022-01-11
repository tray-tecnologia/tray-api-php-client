<?php

namespace Tray\Client\Contracts;

use GuzzleHttp\ClientInterface;

interface IAuth
{
    /**
     * Attach the authorization strategy to the given client.
     *
     * @param  ClientInterface $httpClient
     * @return ClientInterface
     */
    public function authorize(ClientInterface $httpClient): ClientInterface;
}
