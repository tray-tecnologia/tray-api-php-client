<?php

namespace Tray\Support\Contracts;

use Countable;

interface ICollection extends IArrayable, Countable
{
    /**
     * Create a new collection.
     *
     * @param mixed $items
     */
    public function __construct($items = []);

    /**
     * Get all of the items in the collection.
     *
     * @return array
     */
    public function all();

    /**
     * Run a map over each of the items.
     *
     * @param  callable $callback
     * @return static
     */
    public function map(callable $callback);

    /**
     * Push one or more items onto the end of the collection.
     *
     * @param  mixed $values
     * @return static
     */
    public function push(...$values);

    /**
     * Put an item in the collection by key.
     *
     * @param  mixed  $key
     * @param  mixed  $value
     * @return static
     */
    public function put($key, $value);

    /**
     * Returns the item with the given key.
     *
     * @param  mixed $key
     * @param  mixed|null $default
     * @return mixed
     */
    public function get($key, $default = null);

    /**
     * Remove an item from the collection by key.
     *
     * @param  string|array  $keys
     * @return $this
     */
    public function forget($keys);

    /**
     * Determines if the given offset exists.
     *
     * @param  mixed $key
     * @return bool
     */
    public function has($key): bool;
}
