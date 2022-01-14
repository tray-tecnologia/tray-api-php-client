<?php

namespace Tray\Support;

use ArrayAccess;
use IteratorAggregate;
use JsonSerializable;
use ArrayIterator;
use Traversable;
use Tray\Support\Contracts\{ICollection, IArrayable};

/**
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class Collection implements ICollection, ArrayAccess, IteratorAggregate, JsonSerializable
{
    /**
     * The items contained in the collection.
     *
     * @var array
     */
    protected $items = [];

    /**
     * Create a new collection.
     *
     * @param mixed $items
     */
    public function __construct($items = [])
    {
        $this->items = $this->getArrayableItems($items);
    }

    /**
     * {@inheritDoc}
     */
    public function all()
    {
        return $this->items;
    }

    /**
     * {@inheritDoc}
     */
    public function push(...$values)
    {
        foreach ($values as $value) {
            $this->items[] = $value;
        }

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function map(callable $callback)
    {
        return new static(
            array_map($callback, $this->all()),
        );
    }

    /**
     * @inheritDoc
     */
    public function put($key, $value)
    {
        $this->offsetSet($key, $value);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function get($key, $default = null)
    {
        return $this->offsetGet($key);
    }

    /**
     * @inheritDoc
     */
    public function forget($keys)
    {
        foreach ((array) $keys as $key) {
            $this->offsetUnset($key);
        }

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function has($key): bool
    {
        return $this->offsetExists($key);
    }

    /**
     * Determine if an item exists at an offset.
     *
     * @param  mixed $key
     * @return bool
     */
    public function offsetExists($key): bool
    {
        return isset($this->items[$key]);
    }

    /**
     * Get an item at a given offset.
     *
     * @param  mixed $key
     * @return mixed
     */
    public function offsetGet($key)
    {
        return $this->items[$key];
    }

    /**
     * Set the item at a given offset.
     *
     * @param  mixed $key
     * @param  mixed $value
     * @return void
     */
    public function offsetSet($key, $value)
    {
        if (is_null($key)) {
            $this->items[] = $value;
            return;
        }

        $this->items[$key] = $value;
    }

    /**
     * Unset the item at a given offset.
     *
     * @param  string $key
     * @return void
     */
    public function offsetUnset($key)
    {
        unset($this->items[$key]);
    }

    /**
     * @inheritDoc
     */
    public function toArray(): array
    {
        return array_map(
            function ($value) {
                return $value instanceof IArrayable ? $value->toArray() : $value;
            },
            $this->items
        );
    }

    /**
     * @inheritDoc
     */
    public function getIterator()
    {
        return new ArrayIterator($this->items);
    }

    /**
     * @inheritDoc
     */
    public function count()
    {
        return count($this->items);
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        return $this->toArray();
    }

    /**
     * Results array of items from Collection or Arrayable.
     *
     * @param  mixed $items
     * @return array
     */
    protected function getArrayableItems($items): array
    {
        if (is_array($items)) {
            return $items;
        }

        if ($items instanceof JsonSerializable) {
            return (array) $items->jsonSerialize();
        }

        if ($items instanceof Traversable) {
            return iterator_to_array($items);
        }

        return (array) $items;
    }
}
