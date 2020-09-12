<?php

namespace App\Repositories;

use App\Models\Product;
use App\Models\Product\Metric;
use Illuminate\Support\Collection;

class MetricsRepository
{
    /**
     * Find the metric for a given product.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function forProduct(Product $product)
    {
        return $product->metrics();
    }

    /**
     * Find the specific metric for a product.
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
     * Store many metrics for a given product.
     *
     * @param  \App\Models\Product  $product
     * @param  \Illuminate\Support\Collection  $metrics
     * @return \Illuminate\Support\Collection
     */
    public function storeMany(Product $product, Collection $metrics)
    {
        return $metrics
            ->map(function ($value, $key) use ($product) {
                return Metric::updateOrCreate([
                    'product_id' => $product->id,
                    'key' => $key,
                ], [
                    'value' => $value
                ]);
            });
    }
}
