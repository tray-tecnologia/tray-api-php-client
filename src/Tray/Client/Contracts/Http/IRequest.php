<?php

namespace Tray\Client\Contracts\Http;

use GuzzleHttp\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Tray\Support\Contracts\IArrayable;

interface IRequest
{
    /**
     * IRequest constructor.
     *
     * @param ClientInterface $httpClient
     */
    public function __construct(ClientInterface $httpClient);

    /**
     * Returns the authorized http client.
     *
     * @return ClientInterface
     */
    public function getHttpClient(): ClientInterface;

    /**
     * Runs the given request.
     *
     * @param  RequestInterface $request
     * @param  array            $queries
     * @return IResponse
     */
    public function execute(RequestInterface $request, array $queries = []): IResponse;

    /**
     * Make requests with the GET method.
     *
     * @param  string $uri
     * @param  array  $queries
     * @param  array  $headers
     * @return IResponse
     */
    public function get($uri, array $queries = [], array $headers = []): IResponse;

    /**
     * Make requests with the POST method.
     *
     * @param  string                $uri
     * @param  array                 $queries
     * @param  array|IArrayable|null $body
     * @param  array                 $headers
     * @return IResponse
     */
    public function post($uri, array $queries = [], $body = null, array $headers = []): IResponse;

    /**
     * Make requests with the UPDATE method.
     *
     * @param  string                $uri
     * @param  array                 $queries
     * @param  array|IArrayable|null $body
     * @param  array                 $headers
     * @return IResponse
     */
    public function update($uri, array $queries = [], array $headers = [], $body = null): IResponse;

    /**
     * Make requests with the DELETE method.
     *
     * @param  string $uri
     * @param  array  $queries
     * @param  array  $headers
     * @return IResponse
     */
    public function delete($uri, array $queries = [], array $headers = []): IResponse;
}
