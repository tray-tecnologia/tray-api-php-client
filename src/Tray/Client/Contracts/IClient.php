<?php

namespace Tray\Client\Contracts;

use Tray\Client\Contracts\Auth\IAuthenticator;
use Tray\Client\Contracts\Http\IRequest;

/**
 * @author Rodrigo Damasceno <rodrigo.damasceno@tray.net.br>
 */
interface IClient
{
    /**
     * This client is currently in beta version.
     *
     * @var string
     */
    public const VERSION = '0.1.0';

    /**
     * IClient constructor.
     *
     * @param IConfig $config
     * @param IAuthenticator|null $authHandler
     */
    public function __construct(IConfig $config, ?IAuthenticator $authHandler);

    /**
     * Returns the config instance.
     *
     * @return IConfig
     */
    public function getConfig(): IConfig;

    /**
     * Retrieves the http client.
     *
     * @return IRequest
     */
    public function getRequest(): IRequest;
}
