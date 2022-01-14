<?php

namespace Tray\Pagination;

use ArrayAccess;
use ArrayIterator;
use IteratorAggregate;
use JsonSerializable;
use Tray\Support\Contracts\ICollection;

class Paginator implements Contracts\IPaginator, ArrayAccess, IteratorAggregate, JsonSerializable
{
    /**
     * @var ICollection $items
     */
    protected $items;

    /**
     * @var array $paging
     */
    protected $paging;

    /**
     * @inheritDoc
     */
    public function __construct(ICollection $items, array $paging)
    {
        $this->items            = $items;
        $this->paging           = $paging;
    }

    /**
     * @inheritDoc
     */
    public function getItems(): ICollection
    {
        return $this->items;
    }

    /**
     * @inheritDoc
     */
    public function getPageNumber(): int
    {
        return $this->paging['page'] ?? 0;
    }

    /**
     * @inheritDoc
     */
    public function getPageSize(): int
    {
        return $this->paging['limit'] ?? 0;
    }

    /**
     * @inheritDoc
     */
    public function getTotal(): int
    {
        return $this->paging['total'] ?? 0;
    }

    /**
     * @inheritDoc
     */
    public function getIterator()
    {
        return new ArrayIterator($this->items->all());
    }

    /**
     * Determine if an item exists at an offset.
     *
     * @param  mixed $offset
     * @return bool
     */
    public function offsetExists($offset)
    {
        return $this->items->has($offset);
    }

    /**
     * Get an item at a given offset.
     *
     * @param  mixed $offset
     * @return mixed
     */
    public function offsetGet($offset)
    {
        return $this->items->get($offset);
    }

    /**
     * Set the item at a given offset.
     *
     * @param  mixed $offset
     * @param  mixed $value
     * @return void
     */
    public function offsetSet($offset, $value)
    {
        $this->items->put($offset, $value);
    }

    /**
     * Unset the item at a given offset.
     *
     * @param  string $offset
     * @return void
     */
    public function offsetUnset($offset)
    {
        $this->items->forget($offset);
    }

    /**
     * @inheritDoc
     */
    public function count()
    {
        return $this->items->count();
    }

    /**
     * @inheritDoc
     */
    public function toArray(): array
    {
        return [
            'paging' => $this->paging,
            'items'  => $this->items->toArray(),
        ];
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        return $this->toArray();
    }
}
