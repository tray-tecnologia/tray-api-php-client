<?php

namespace Tray\Client\Contracts\Http;

use Psr\Http\Message\ResponseInterface;

interface IResponseErrorHandler
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
     * IErrorHandler's constructor.
     *
     * @param ResponseInterface $response
     */
    public function __construct(ResponseInterface $response);

    /**
     * Handles the request response error.
     *
     * @return mixed
     */
    public function handle();
}
