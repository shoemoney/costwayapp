<?php

namespace App\Repositories;

use Carbon\Carbon;
use App\Models\Product;
use App\Models\Activity;

class ActivityRepository
{
    /**
     * Find the specific activity for a product.
     *
     * @param  \App\Models\Product  $product
     * @param  mixed  $key
     * @return \App\Models\Activity|null
     */
    public function find(Product $product, $key)
    {

        return $product->activity()
            ->where('action', $key)
            ->latest()
            ->first();
    }


    /**
     * Store the specific activity for a product.
     * @param  \App\Models\Product  $product
     * @param  array  $data
     * @return \App\Models\Activity
     */
    public function store(Product $product, array $data)
    {
        return Activity::create([
            'user_id' => $product->user->id,
            'activeable_id' => $product->id,
            'activeable_type' => get_class($product),
            'action' => $data['action'],
            'metadata' => json_encode($data['metadata']),
        ]);
    }

    /**
     * Return true if the product is back in stock.
     * @param  \App\Models\Product  $product
     * @return bollean
     */
    public function InStockActivityIsAboveProductRemoveActivity(Product $product) {
        if ($this->find($product, 'product_in_stock') && $this->find($product, 'product_removed')) {
            if (Carbon::parse($this->find($product, 'product_in_stock')->created_at) >= Carbon::parse($this->find($product, 'product_removed')->created_at)){
                return true;
            }
        }

        return false;
    }

}
