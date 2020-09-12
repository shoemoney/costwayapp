<?php

namespace App\Collections;

use Illuminate\Support\Collection;
use App\Integrations\Ebay\Entities\Product as ProductEntity;

class ProductsCollection extends Collection
{
    /**
     * Create a new instace of this collection and map to the product entity.
     *
     * @param  array  $items
     * @return \App\Collections\ProductsCollection
     */
    public static function build(array $items)
    {
        return new static(
            array_map([ProductEntity::class, 'fromResponse'], $items)
        );
    }

    /**
     * Pluck the primary key of each entity in the collection.
     *
     * @return \Illuminate\Support\Collection
     */
    public function pluckPrimaryKey()
    {
        return $this->pluck(ProductEntity::PRIMARY_KEY)
            ->toBase();
    }

    /**
     * Convert all Product Entities to their model format.
     *
     * @return array
     */
    public function toModels()
    {
        return $this
            ->map->toModel()
            ->toArray();
    }
}
