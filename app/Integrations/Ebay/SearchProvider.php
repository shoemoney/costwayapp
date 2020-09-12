<?php

namespace App\Integrations\Ebay;

use App\Integrations\Ebay\Ebay;
use App\Integrations\Ebay\Provider;
use App\Integrations\Ebay\Requests\GetItemsRequest;
use App\Contracts\Integrations\ProductSearchInterface;
use App\Integrations\Ebay\Requests\SearchStoreRequest;
use App\Integrations\Ebay\Requests\SearchByKeywordRequest;
use App\Integrations\Ebay\Requests\MostWatchedItemsByCategoryRequest;

class SearchProvider extends Provider implements ProductSearchInterface
{
    /**
     * Search a product category by a given identifier.
     *
     * @param  mixed  $identifier
     * @return \App\Integrations\Http\Response
     */
    public function category($identifier)
    {
        return (new MostWatchedItemsByCategoryRequest())
            ->search($identifier);
    }

    /**
     * Search products by a given keyword.
     *
     * @param  string  $keyword
     * @param  int  $page
     * @return \App\Integrations\Http\Response
     */
    public function keyword(string $keyword, int $page = 1)
    {
        return (new SearchByKeywordRequest())
            ->search($keyword, $page);
    }

    /**
     * Search a given store's products.
     *
     * @param  string  $identifier
     * @param  int  $page
     * @return \App\Integrations\Http\Response
     */
    public function store(string $identifier, int $page = 1)
    {
        return (new SearchStoreRequest())
            ->search($identifier, $page);
    }
}
