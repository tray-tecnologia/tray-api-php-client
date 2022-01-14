<?php

namespace Tray\Support\Contracts;

interface IHydrator
{
    /**
     * Hydrates the target instance with the given content.
     *
     * @param array $content
     * @param mixed $target
     * @return void
     */
    public function hydrate(array $content, $target): void;
}
