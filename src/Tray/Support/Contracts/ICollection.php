<?php

namespace Tray\Support\Contracts;

use ArrayAccess;
use Countable;
use IteratorAggregate;
use JsonSerializable;

interface ICollection extends IArrayable, ArrayAccess, Countable, IteratorAggregate, JsonSerializable
{
    /**
     * Create a new collection.
     *
     * @param mixed $items
     */
    public function __construct($items = []);
}
