<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductController
{
    /**
     * Display a page to view all information about the product.
     *
     * @param  string  $product
     * @return \Illuminate\Http\Response
     */
    public function show($product)
    {
        $data = [
            'product' => Product::with('metadata', 'metrics', 'store', 'sales')->findOrFail($product),
        ];

        return request()->expectsJson()
        ? $data
        : view('products.show', $data);
    }
}
