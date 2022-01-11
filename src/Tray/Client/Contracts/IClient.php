<?php

namespace Tray\Client\Contracts;

use GuzzleHttp\ClientInterface;

/**
 * @author Rodrigo Damasceno <rodrigo.damasceno@tray.net.br>
 *
 * @version 0.1.0
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
     * @param IAuth   $authHandler
     */
    public function __construct(IConfig $config, IAuth $authHandler);

    /**
     * Returns the config instance.
     *
     * @return IConfig
     */
    public function getConfig(): IConfig;

    /**
     * Returns a http client with the authorization strategy.
     *
     * @return ClientInterface
     */
    public function authorize(): ClientInterface;
}
