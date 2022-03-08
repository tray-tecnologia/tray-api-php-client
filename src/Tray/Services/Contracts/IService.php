<?php

namespace Tray\Services\Contracts;

use RuntimeException;
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
     * The resource classes.
     *
     * @var class-string<IResource>[] $bindings
     */
    protected $bindings = [];

    /**
     * The instances of the resources.
     *
     * @var IResource[] $resources
     */
    protected $resources = [];

    /**
     * IService's constructor.
     *
     * @param IClient $client
     */
    public function __construct(IClient $client)
    {
        $this->client = $client;
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
     * Looks at the resource bindings and try to resolve the given property name.
     *
     * @param string $name
     * @return IResource
     */
    public function __get($name)
    {
        if (isset($this->resources[$name])) {
            return $this->resources[$name];
        }

        if (!isset($this->bindings[$name])) {
            throw new RuntimeException("Resource '$name' not found");
        }

        if (!is_a($this->bindings[$name], IResource::class, true)) {
            throw new RuntimeException("Resource '$name' must be an instance of " . IResource::class);
        }

        return $this->resources[$name] = new $this->bindings[$name]($this);
    }
}
