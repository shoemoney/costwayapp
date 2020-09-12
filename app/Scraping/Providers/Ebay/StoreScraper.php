<?php

namespace App\Scraping\Providers\Ebay;

use App\Concerns\Scraping\ParsesHtml;
use App\Concerns\Scraping\MakesRequests;
use Illuminate\Contracts\Support\Arrayable;

class StoreScraper implements Arrayable
{
    use ParsesHtml;
    use MakesRequests;

    /** @var array */
    protected $products = [];

    /** @var string */
    protected $username = "";

    /**
     * @param string $term
     */
    public function __construct($username)
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    protected function makeUrl(): string
    {
        return "https://www.ebay.co.uk/str/{$this->username}";
    }

    /**
     * @return \App\Scraping\Providers\Ebay\SearchScraper|$this
     */
    public function scrape(): StoreScraper
    {
        $this->parse(
            $this->httpClient()->get($this->makeUrl())
        );

        $this->products = array_map(function ($product) {
            $url = $product->find("a.s-item__link")[0]->getAttribute('href');
            return [
                'id' => preg_replace("/(^(.*[\/])|(\?.*)$)/", "", $url),
                'url' => $url,
                'title' => $product->find("h3")[0]->text(),
                'price' => $product->find("span.s-item__price")[0]->text(true),
                'original_price' => null,
                'images' => [
                    [
                        'alt' => ($image = $product->find("img")[0])->getAttribute('alt'),
                        'src' => $image->getAttribute('src')
                    ]
                ]
            ];
        }, $this->find(".s-item")->toArray());
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