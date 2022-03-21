<?php

namespace Tray\Client\Contracts\Auth;

use Tray\Client\Contracts\IConfig;

interface IAuthenticator
{
    /**
     * IAuthenticator constructor.
     *
     * @param IGuard $guard
     * @param IConfig $config
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
