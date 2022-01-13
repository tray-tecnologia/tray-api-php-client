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
     * @param array $options
     */
    public function __construct(ClientInterface $httpClient, array $options);

    /**
     * Returns the authorized http client.
     *
     * @return ClientInterface
     */
    public function getHttpClient(): ClientInterface;

    /**
     * Creates a new Request instance with the given response.
     * @param class-string<IResponse> $response
     *
     * @return IRequest
     */
    public function withResponse(string $response): IRequest;

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
