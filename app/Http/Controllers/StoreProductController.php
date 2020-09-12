<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Models\Product;

class StoreProductController
{
    public function index($provider, $storeIdentifier)
    {
        $store = Store::where('provider', $provider)
            ->where('identifier', $storeIdentifier)
            ->orWhere('name', $storeIdentifier)
            ->firstOrFail();

        return Product::withCount('sales')
            ->with(['metrics', 'metadata'])
            ->orderByDesc('sales_count')
            ->soldBy($store)
            ->get();
    }
}
