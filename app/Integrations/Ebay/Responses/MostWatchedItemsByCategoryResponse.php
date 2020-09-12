<?php

namespace App\Integrations\Ebay\Responses;

use Illuminate\Support\Arr;
use App\Integrations\Http\Response;
use App\Collections\ProductsCollection;

class MostWatchedItemsByCategoryResponse extends Response
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
            Arr::get($body, 'getMostWatchedItemsResponse.itemRecommendations.item')
        );
    }
}
