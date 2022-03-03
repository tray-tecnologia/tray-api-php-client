<?php

namespace Tray\Client\Http;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Psr7\Request as HttpRequest;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Throwable;
use Tray\Client\Contracts\Http\{IResponseErrorHandler, IRequest, IResponse};
use Tray\Client\Exception\RequestException;
use Tray\Support\Contracts\IArrayable;

class Request implements IRequest
{
    /**
     * Http client instance.
     *
     * @var ClientInterface $httpClient
     */
    protected $httpClient;

    /**
     * @inheritDoc
     */
    public function __construct(ClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * @inheritDoc
     */
    public function getHttpClient(): ClientInterface
    {
        return $this->httpClient;
    }

    /**
     * @inheritDoc
     * @throws     RequestException
     */
    public function execute(RequestInterface $request, array $queries = []): IResponse
    {
        $request = $request
            ->withHeader('Content-Type', 'application/json')
            ->withHeader('Accept', 'application/json');

        try {
            $httpResponse = $this->httpClient->send($request, ['query' => $queries]);
        } catch (BadResponseException $e) {
            $httpResponse = $e->getResponse();
        } catch (Throwable $e) {
            throw new RequestException($e->getMessage(), $e->getCode());
        }

        if ($httpResponse->getStatusCode() >= 400) {
            $this->makeResponseErrorHandler($httpResponse)->handle();
        }

        return $this->makeResponse($httpResponse);
    }

    /**
     * @inheritDoc
     * @throws     RequestException
     */
    public function get($uri, array $queries = [], array $headers = []): IResponse
    {
        $request = new HttpRequest('GET', $this->normalizesUri($uri), $headers);
        return $this->execute($request, $queries);
    }

    /**
     * @inheritDoc
     * @throws     RequestException
     */
    public function post($uri, array $queries = [], $body = null, array $headers = []): IResponse
    {
        $body = $this->toJson($body);

        $request = new HttpRequest('POST', $this->normalizesUri($uri), $headers, $body);
        return $this->execute($request, $queries);
    }

    /**
     * @inheritDoc
     * @throws     RequestException
     */
    public function update($uri, array $queries = [], array $headers = [], $body = null): IResponse
    {
        $body = $this->toJson($body);

        $request = new HttpRequest('PUT', $this->normalizesUri($uri), $headers, $body);
        return $this->execute($request, $queries);
    }

    /**
     * @inheritDoc
     * @throws     RequestException
     */
    public function delete($uri, array $queries = [], array $headers = []): IResponse
    {
        $request = new HttpRequest('PUT', $this->normalizesUri($uri), $headers);
        return $this->execute($request, $queries);
    }

    /**
     * Parse the given body request to json
     *
     * @param  array|IArrayable|null $body
     * @return string|null
     */
    protected function toJson($body)
    {
        if (!$body) {
            return null;
        }

        if ($body instanceof IArrayable) {
            $body = $body->toArray();
        }

        $json = json_encode($body);
        return $json ? $json : null;
    }

    /**
     * Normalizes the uri given.
     * The url should not begin with '/'.
     *
     * @param  string $uri
     * @return string
     */
    protected function normalizesUri(string $uri): string
    {
        return preg_replace('/^\/+/', '', $uri);
    }

    /**
     * @param ResponseInterface $httpResponse
     * @return IResponse
     */
    protected function makeResponse(ResponseInterface $httpResponse): IResponse
    {
        return new JsonResponse($httpResponse);
    }

    /**
     * @param ResponseInterface $httpResponse
     * @return IResponseErrorHandler
     */
    protected function makeResponseErrorHandler(ResponseInterface $httpResponse): IResponseErrorHandler
    {
        return new ResponseErrorHandler($httpResponse);
    }
}
