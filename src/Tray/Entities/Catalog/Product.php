<?php

namespace Tray\Entities\Catalog;

use Tray\Entities\Entity;
use Tray\Entities\Generic\Url;

/**
 * @property int                   $id
 * @property int                   $brand_id
 * @property int                   $category_id
 * @property int                   $hot            Determines if the product is a highlight product. (1 or 0)
 * @property int                   $release        Determines if the product is a release. (1 or 0)
 * @property int                   $available      Determines if the product is active. (1 or 0)
 * @property int                   $availability   Determines if the product is available for sale. (1 or 0)
 * @property int                   $is_kit         Determines whether the product is a kit or not. (1 or 0)
 * @property int                   $has_variation  Determines if the product has variations. (1 or 0)
 * @property string                $ean
 * @property string                $ncm
 * @property string                $slug
 * @property string                $name
 * @property string                $brand
 * @property float                 $price
 * @property float                 $promotional_price
 * @property ProductVariant[]      $Variant
 * @property Url                   $url
 * @property ProductImage[]|null   $ProductImage
 * @property string                $payment_option
 * @property ProductPaymentOptionDetail[]|null $payment_option_details  Details about the payment option.
 */
class Product extends Entity
{
    /**
     * @inheritDoc
     */
    protected $casts = [
        'id'                 => 'integer',
        'brand_id'           => 'integer',
        'category_id'        => 'integer',
        'is_kit'             => 'integer',
        'has_variation'      => 'integer',
        'hot'                => 'integer',
        'release'            => 'integer',
        'available'          => 'integer',
        'availability'       => 'integer',
        'price'              => 'float',
        'promotional_price'  => 'float',
    ];

    /**
     * Sets the product's images.
     *
     * @param  mixed $values
     * @return void
     */
    public function setProductImageAttribute($values): void
    {
        if (!is_array($values)) {
            $this->attributes['ProductImage'] = null;
            return;
        }

        $this->attributes['ProductImage'] = array_map(function ($attributes) {
            return new ProductImage($attributes);
        }, $values);
    }

    /**
     * Sets the product's payment details.
     *
     * @param  mixed $value
     * @return void
     */
    public function setPaymentOptionDetails($value): void
    {
        if (!is_array($value)) {
            $this->attributes['payment_option_details'] = null;
            return;
        }

        $this->attributes['payment_option_details'] = new ProductPaymentOptionDetail($value);
    }

    /**
     * Sets the product's url.
     *
     * @param  mixed $value
     * @return void
     */
    public function setUrlAttribute($value): void
    {
        $this->attributes['url'] = new Url($value);
    }

    /**
     * Sets the product's variations.
     *
     * @param  mixed $values
     * @return void
     */
    public function setVariantAttribute($values): void
    {
        $this->attributes['Variant'] = array_map(function ($attributes) {
            return new ProductVariant($attributes);
        }, $values);
    }
}
