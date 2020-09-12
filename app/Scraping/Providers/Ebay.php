<?php

namespace App\Scraping\Providers;

use App\Scraping\Providers\Ebay\SalesScraper;
use App\Scraping\Providers\Ebay\StoreScraper;
use App\Scraping\Providers\Ebay\SearchScraper;
use App\Scraping\Providers\Ebay\ProductScraper;
use App\Scraping\Providers\Ebay\CategoriesScraper;

class Ebay
{
    /**
     * Scrape a product by URL.
     *
     * @var  string  $url
     * @return \App\Scraping\Providers\Ebay\ProductScraper
     */
    public function product($url): ProductScraper
    {
        return (new ProductScraper($url))
            ->scrape()
            ->withSales();
    }

    /**
     * Scrape an eBay search by keyword.
     *
     * @var  string  $term
     * @return \App\Scraping\Providers\Ebay\SearchScraper
     */
    public function search($term): SearchScraper
    {
        return (new SearchScraper($term))
            ->scrape();
    }

    /**
     * Scrape an eBay store's products.
     *
     * @var  string  $username
     * @return \App\Scraping\Providers\Ebay\StoreScraper
     */
    public function store($username): StoreScraper
    {
        return (new StoreScraper($username))
            ->scrape();
    }

    /**
     * Scrape the categories available in eBay.
     *
     * @return \App\Scraping\Providers\Ebay\CategoriesScraper
     */
    public function categories(): CategoriesScraper
    {
        return (new CategoriesScraper())
            ->scrape();
    }

    /**
     * Scrape the last 100 sales of a product.
     *
     * @param  string  $id
     * @return \App\Scraping\Providers\Ebay\SalesScraper
     */
    public function sales($id): SalesScraper
    {
        return (new SalesScraper($id))
            ->scrape();
    }
}
