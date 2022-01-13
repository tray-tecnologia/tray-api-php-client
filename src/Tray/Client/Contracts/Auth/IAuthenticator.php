<?php

namespace Tray\Client\Contracts\Auth;

use Tray\Client\Contracts\IConfig;

interface IAuthenticator
{
    /**
     * IHandler constructor.
     *
     * @param IGuard $guard
     */
    public function __construct(IGuard $guard, IConfig $config);

    /**
     * Attach the authorization strategy to the given client.
     *
     * @param callable $handler
     * @return callable
     */
    public function __invoke(callable $handler): callable;
}
