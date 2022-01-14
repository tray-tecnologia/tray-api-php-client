<?php

namespace Tray\Client\Http;

use Psr\Http\Message\ResponseInterface;
use Tray\Client\Contracts\Http\IResponseErrorHandler;
use Tray\Client\Exception\{
    ClientException,
    RequestException,
    ServerException,
    UnauthorizedException,
    ValidationException
};

class ResponseErrorHandler implements IResponseErrorHandler
{
    /**
     * Http client response.
     *
     * @var ResponseInterface $response
     */
    protected $response;

    /**
     * @inheritDoc
     */
    public function __construct(ResponseInterface $response)
    {
        $this->response = $response;
    }

    /**
     * @inheritDoc
     * @throws ClientException
     * @throws ServerException
     * @throws RequestException
     */
    public function handle()
    {
        $statusCode = $this->response->getStatusCode();

        $method = "onStatus{$statusCode}";
        if (method_exists($this, $method)) {
            return $this->$method();
        }

        $clientError = self::ERRORS[$statusCode] ?? null;
        if ($clientError) {
            throw new ClientException($clientError, $statusCode);
        }

        $serverError = self::FAILURES[$statusCode] ?? null;
        if ($serverError) {
            throw new ServerException($serverError, $statusCode);
        }

        throw new RequestException('Unknown Error', $statusCode);
    }

    /**
     * Tratamento para requisições não autorizadas.
     *
     * @return void
     * @throws UnauthorizedException
     */
    protected function onStatus401(): void
    {
        throw new UnauthorizedException();
    }

    /**
     * Tratamento para erros de validação.
     *
     * @return void
     * @throws ValidationException
     */
    protected function onStatus422(): void
    {
        $contents = $this->response->getBody()->getContents();
        $contents = json_decode($contents, true);

        throw new ValidationException($contents['errors'] ?? []);
    }

    /**
     * Tratamento para erros de validação.
     *
     * @return void
     * @throws ValidationException
     */
    protected function onStatus400(): void
    {
        $this->onStatus422();
    }
}
