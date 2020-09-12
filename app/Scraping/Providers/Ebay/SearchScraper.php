<?php

namespace App\Scraping\Providers\Ebay;

use App\Concerns\Scraping\ParsesHtml;
use App\Concerns\Scraping\MakesRequests;
use Illuminate\Contracts\Support\Arrayable;

class SearchScraper implements Arrayable
{
    use ParsesHtml;
    use MakesRequests;

    /** @var string */
    protected $term = "";

    /** @var array */
    protected $products = [];

    /**
     * @param string $term
     */
    public function __construct($term)
    {
        $this->term = $term;
    }

    /**
     * @return string
     */
    protected function makeUrl(): string
    {
        return "https://www.ebay.co.uk/sch/i.html?_nkw={$this->term}";
    }

    /**
     * @return \App\Scraping\Providers\Ebay\SearchScraper|$this
     */
    public function scrape(): SearchScraper
    {
        $this->parse(
            $this->httpClient()->get($this->makeUrl())
        );

        $this->products = array_map(function ($product) {
            return [
                'id' => $product->getAttribute('listingId'),
                'url' => $product->find("a")[0]->getAttribute('href'),
                'title' => $product->find("h3 a")[0]->text(),
                'price' => $product->find(".lvprice .bold")[0]->text(),
                'original_price' => optional($product->find(".lvprice .stk-thr")[0])->text(),
                'images' => [
                    [
                        'alt' => ($image = $product->find("img")[0])->getAttribute('alt'),
                        'src' => $image->getAttribute('src')
                    ]
                ]
            ];
        }, $this->find("[listingId]")->toArray());
        return $this;
    }

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return $this->products;
    }
}
