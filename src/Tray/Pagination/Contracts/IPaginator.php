<?php

namespace Tray\Pagination\Contracts;

use Tray\Support\Contracts\{IArrayable, ICollection};
use Countable;

interface IPaginator extends IArrayable, Countable
{
    /**
     * IPaginator constructor.
     *
     * @param ICollection $items
     * @param array       $paging
     */
    public function __construct(ICollection $items, array $paging);

    /**
     * Returns the items.
     *
     * @return ICollection
     */
    public function getItems(): ICollection;

    /**
     * Returns the current page.
     *
     * @return int
     */
    public function getPageNumber(): int;

    /**
     * Returns the total of items per page.
     *
     * @return int
     */
    public function getPageSize(): int;

    /**
     * Returns the total of pages
     *
     * @return int
     */
    public function getTotal(): int;
}
