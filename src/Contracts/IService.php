<?php

namespace Tray\Contracts;

interface IService
{
    /**
     * IService constructor.
     *
     * @param IClient $client
     */
    public function __construct(IClient $client);
}
