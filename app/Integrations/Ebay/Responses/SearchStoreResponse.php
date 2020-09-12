<?php

namespace App\Integrations\Ebay\Responses;

use App\Collections\ProductsCollection;
use App\Integrations\Ebay\Entities\Product;
use App\Integrations\Http\Response;
use Illuminate\Support\Arr;

class SearchStoreResponse extends Response
{
    /**
     * Get the body attribute.
     *
     * @return mixed
     */
    public function getBody()
    {
        $body = json_decode($this->body, true);

        return ProductsCollection::make(
            collect(Arr::get($body, 'findItemsAdvancedResponse.0.searchResult.0.item'))
                ->map(function ($product) {
                    return Product::fromResponse(
                        tap($result = [], function (&$result) use ($product) {
                            collect(Arr::dot($product))
                                ->each(function ($value, $key) use (&$result) {
                                    Arr::set($result, str_replace(['_', '@', '.0'], '', $key), $value);
                                });
                        })
                    );
                })->all()
        );
    }
}
