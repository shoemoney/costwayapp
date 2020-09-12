<?php

namespace App\Repositories;

use App\Models\Product;
use App\Models\Product\Meta;
use Illuminate\Support\Collection;

class MetadataRepository
{
    /** @var array */
    private $blacklist = [
        'categories'
    ];

    /**
     * Find the metadata for a given product.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function forProduct(Product $product)
    {
        return $product->metadata();
    }

    /**
     * Find the specific meta for a product.
     *
     * @param  \App\Models\Product  $product
     * @param  mixed  $key
     * @return \App\Models\Products\Sale|null
     */
    public function find(Product $product, $key)
    {
        return $this->forProduct($product)
            ->where('key', $key)
            ->first();
    }

    /**
     * Store many metadata for a given product.
     *
     * @param  \App\Models\Product  $product
     * @param  \Illuminate\Support\Collection  $metadata
     * @return \Illuminate\Support\Collection
     */
    public function storeMany(Product $product, Collection $metadata)
    {
        return $metadata
            ->filter(function ($meta, $key) {
                return ! in_array($key, $this->blacklist);
            })
            ->map(function ($value, $key) use ($product) {
                return Meta::updateOrCreate([
                    'product_id' => $product->id,
                    'key' => $key,
                ], [
                    'value' => $value
                ]);
            });
    }
}
