<?php

namespace Tray\Entities\Catalog;

use Tray\Entities\Generic\Url;

/**
 * @property Url[] $thumbs
 */
class ProductImage extends Url
{
    /**
     * Defines the thumbs attribute.
     *
     * @param mixed $values
     * @return void
     */
    public function setThumbsAttribute($values): void
    {
        $this->thumbs = [];
        if (!is_array($values)) {
            return;
        }

        foreach ($values as $size => $url) {
            $this->thumbs[$size] = new Url($url);
        }
    }

    /**
     * Returns the thumb image for the given size.
     * The available sizes are 30, 60 and 90.
     *
     * @param string $size
     * @return Url | null
     */
    public function getThumbs(string $size = '30')
    {
        return $this->thumbs[$size] ?? null;
    }
}
