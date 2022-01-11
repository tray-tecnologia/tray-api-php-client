<?php

namespace Tray\Support\Contracts;

interface IArrayable
{
    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray(): array;
}
