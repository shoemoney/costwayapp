<?php

namespace App\Integrations\Ebay\Responses;

use Illuminate\Support\Arr;
use App\Integrations\Http\Response;
use App\Collections\ProductsCollection;

class SearchByKeywordResponse extends Response
{
    /**
     * Get the body attribute.
     *
     * @return mixed
     */
    public function getBody()
    {
        $body = json_decode($this->body, true);

        return ProductsCollection::build(
            collect(Arr::get($body, 'findItemsByKeywordsResponse.0.searchResult.0.item'))
                ->map(function ($product) {
                    return tap($result = [], function (&$result) use ($product) {
                        collect(Arr::dot($product))
                                ->each(function ($value, $key) use (&$result) {
                                    Arr::set($result, str_replace(['_', '@', '.0'], '', $key), $value);
                                });
                    });
                })->toArray()
        );
    }
}
