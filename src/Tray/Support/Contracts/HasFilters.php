<?php

namespace Tray\Support\Contracts;

interface HasFilters
{
    /**
     * Returns the available filters
     *
     * @return array
     */
    public function getAvailableFilters(): array;

    /**
     * Returns the applied filters
     *
     * @return array
     */
    public function getAppliedFilter(): array;
}
