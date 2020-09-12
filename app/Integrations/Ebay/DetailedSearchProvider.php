<?php

namespace App\Integrations\Ebay;

use App\Contracts\Integrations\ProductSearchInterface;
use App\Integrations\Ebay\Ebay;
use App\Integrations\Ebay\Provider;
use App\Integrations\Ebay\Requests\MostWatchedItemsByCategoryRequest;
use App\Integrations\Ebay\Requests\SearchByKeywordRequest;
use App\Integrations\Ebay\Requests\SearchStoreRequest;

class DetailedSearchProvider extends Provider implements ProductSearchInterface
{
    /**
     * Get the detailed product results.
     *
     * @param  \App\Collections\ProductsCollection  $products
     * @return \App\Integrations\Http\Response
     */
    protected function getDetailedInfo(ProductsCollection $products)
    {
        return $this->provider
            ->products()
            ->get($products->pluckPrimaryKey()->toArray());
    }

    /**
     * Search a product category by a given identifier.
     *
     * @param  mixed  $identifier
     * @return \App\Integrations\Http\Response
     */
    public function category($identifier)
    {
        return $this->getDetailedInfo(
            $products = (new MostWatchedItemsByCategoryRequest())
                ->search($identifier)
                ->getBody()
        );
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
        return $this->getDetailedInfo(
            $products = (new SearchByKeywordRequest())
                ->search($keyword, $page)
        );
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
        return $this->getDetailedInfo(
            (new SearchStoreRequest())
                ->search($identifier, $page)
        );
    }
}
