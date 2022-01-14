<?php

namespace Tray\Client\Exception;

use Throwable;

class UnauthorizedException extends ClientException
{
    /**
     * UnauthorizedException constructor.
     *
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct($message = 'Unauthorized', $code = 401, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
