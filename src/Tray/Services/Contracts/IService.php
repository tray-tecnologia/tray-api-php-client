<?php

namespace Tray\Services\Contracts;

use Tray\Client\Contracts\IClient;

abstract class IService
{
    /**
     * The client instance.
     *
     * @var IClient $client
     */
    protected $client;

    /**
     * Resolução das implementações dos recursos.
     *
     * @var IResource[] $binds
     */
    protected $binds = [];

    /**
     * IService's constructor.
     *
     * @param IClient $client
     */
    public function __construct(IClient $client)
    {
        $this->client = $client;
        $this->makeResources();
    }

    /**
     * Returns the client instance.
     *
     * @return IClient
     */
    public function getClient(): IClient
    {
        return $this->client;
    }

    /**
     * Creates the service's resources.
     *
     * @return void
     */
    abstract protected function makeResources(): void;
}
