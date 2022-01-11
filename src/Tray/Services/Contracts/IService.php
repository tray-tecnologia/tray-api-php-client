<?php

namespace Tray\Services\Contracts;

use Tray\Client\Contracts\IClient;

interface IService
{
    /**
     * IService constructor.
     *
     * @param IClient $client
     */
    public function __construct(IClient $client);
}
