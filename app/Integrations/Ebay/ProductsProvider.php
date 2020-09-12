<?php

namespace App\Integrations\Ebay;

use App\Integrations\Ebay\Requests\GetProductsRequest;
use App\Integrations\Ebay\Requests\GetProductSalesRequest;

class ProductsProvider extends Provider
{
    /**
     * Get the information for products.
     *
     * @param  string  $products
     * @return \App\Integrations\Http\Response
     */
    public function get($products)
    {
        return (new GetProductsRequest())
            ->search($products);
    }

    /**
     * Get the sales for a product.
     *
     * @param  string  $productId
     * @return \Illuminate\Support\Collection
     */
    public function sales($productId)
    {
        return (new GetProductSalesRequest())
            ->forProduct($productId)
            ->getBody()
            ->map->set('product_id', $productId);
    }
}
