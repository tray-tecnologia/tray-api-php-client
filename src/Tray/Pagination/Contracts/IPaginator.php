<?php

namespace Tray\Pagination\Contracts;

use ArrayAccess;
use Countable;
use IteratorAggregate;
use JsonSerializable;
use Tray\Support\Contracts\IArrayable;

interface IPaginator extends IArrayable, ArrayAccess, Countable, IteratorAggregate, JsonSerializable
{
}
