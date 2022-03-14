<?php

namespace Tray\Entities\Catalog;

use Tray\Entities\Entity;
use Tray\Entities\Generic\Url;

/**
 * @property  int     $id
 * @property  int     $parent_id
 * @property  int     $active
 * @property  string  $small_description
 * @property  string  $name
 * @property  string  $description
 * @property  int     $has_product
 * @property  Url[]   $Images
*/
class Category extends Entity
{
    /**
     * @inheritDoc
     */
    protected $casts = [
        'id'           => 'integer',
        'parent_id'    => 'integer',
        'active'       => 'integer',
        'order'        => 'integer',
        'has_product'  => 'integer',
    ];

    /**
     * Sets the category's images.
     *
     * @param  mixed $values
     * @return void
     */
    public function setImagesAttribute($values): void
    {
        if (!is_array($values)) {
            $this->attributes['Images'] = [];
            return;
        }

        $this->attributes['Images'] = array_map(function ($image) {
            return new Url($image);
        }, $values);
    }

    /**
     * Sets the category's link.
     *
     * @param  mixed $value
     * @return void
     */
    public function setLinkAttribute($value): void
    {
        $this->attributes['link'] = new Url($value);
    }
}
