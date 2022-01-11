<?php

namespace Tray\Client\Contracts;

/**
 * @author Rodrigo Damasceno <rodrigo.damasceno@tray.net.br>
 */
interface IConfig
{
    /**
     * IConfig constructor.
     *
     * @param array $configurations
     */
    public function __construct(array $configurations);

    /**
     * The store's api url.
     *
     * @return string
     */
    public function getApiUrl(): string;

    /**
     * Retrieves the application's consumer key.
     * This key is what identifies the consumer.
     *
     * @return string
     */
    public function getConsumerKey(): string;

    /**
     * Retrieves the application's secret key.
     * This key is used along with the consumer key, to request access to the resources.
     *
     * @return string
     */
    public function getConsumerSecret(): string;

    /**
     * The application's authorization code.
     *
     * @return string
     */
    public function getAuthorizationCode(): string;
}
