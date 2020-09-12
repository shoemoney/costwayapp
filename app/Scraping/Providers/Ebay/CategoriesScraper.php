<?php

namespace App\Scraping\Providers\Ebay;

use App\Concerns\Scraping\ParsesHtml;
use App\Concerns\Scraping\MakesRequests;
use Illuminate\Contracts\Support\Arrayable;

class CategoriesScraper implements Arrayable
{
    use ParsesHtml;
    use MakesRequests;

    /** @var array */
    protected $categories = [];

    /**
     * Scrape the eBay categories page for all categories.
     *
     * @return array
     */
    public function scrape()
    {
        $this->parse(
            $this->httpClient()->get("https://www.ebay.co.uk/n/all-categories")
        );

        $this->categories = array_map(function ($category) {
            preg_match("/\/(\d*)\/bn_/", $category->getAttribute('href'), $matches);
            return [
                'id' => $matches[1] ?? '',
                'name' => $category->text(),
                'url' => $category->getAttribute('href')
            ];
        }, $this->find(".l1s-container li a")->toArray());

        $this->categories = array_values(
            array_filter($this->categories, function ($category) {
                return !empty($category['id'] ?? null);
            })
        );

        return $this;
    }

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return $this->categories;
    }
}
