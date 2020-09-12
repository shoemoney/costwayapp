<?php

namespace App\Scraping\Providers\Ebay;

use App\Concerns\Scraping\ParsesHtml;
use App\Concerns\Scraping\MakesRequests;
use Illuminate\Contracts\Support\Arrayable;

class ProductScraper implements Arrayable
{
    use ParsesHtml;
    use MakesRequests;

    /** @var array */
    protected $attributes = [];

    /** @var string */
    protected $url = "";

    /**
     * @param  string  $url
     * @return void
     */
    public function __construct($url)
    {
        $this->url = $url;
    }

    /**
     * Scrape an eBay product page.
     *
     * @param  array  $options
     * @return \App\Scraping\Providers\Ebay\ProductScraper|$this
     */
    public function scrape($options = []): ProductScraper
    {
        $this->parse(
            $this->httpClient()->get($this->url, $options)
        );

        preg_match("/(\/([0-9]*))(\?|$)/", $this->url, $matches);
        $this->attributes['id'] = trim($matches[1], "/");

        $this->attributes['url'] = $this->url;

        $this->attributes['title'] = $this->first("h1[itemprop=name]")->text();
        $this->attributes['description'] = trim($this->first("#subTitle")->text());

        $originalPrice = $this->attributes['original_price'] = $this->first("#orgPrc") ?? null;
        $this->attributes['original_price'] = $originalPrice ? $originalPrice->text() : null;
        $this->attributes['price'] = $this->first("span[itemprop=price]")->text();

        $this->attributes['images'] = [];
        $images = $this->find(".tdThumb img");
        foreach ($images as $image) {
            $this->attributes['images'][] = [
                'alt' => $image->alt,
                'src' => str_replace("s-l64", "s-l300", $image->src)
            ];
        }

        $this->attributes['related_products'] = collect([]);
        $related = $this->find("ul.mfe-recos li");
        foreach ($related as $product) {
            $this->attributes['related_products'][] = [
                'id' => $product->getAttribute("data-id"),
                "url" => explode("?", $product->find("a")[0]->href)[0]
            ];
        }

        $this->attributes['related_products'] = $this->attributes['related_products']->filter(function ($product) {
            return stristr($product['url'], "https://www.ebay.co.uk/itm");
        })->values()->toArray();

        $this->attributes['category'] = $this->find(".bc-w")[0]->text(true);

        $this->attributes['total_reviews'] = $this->getReviews();

        $reviewTags = $this->find(".pie-container .pie-txt");
        $this->attributes['review_tags'] = [];
        foreach ($reviewTags as $tag) {
            $this->attributes['review_tags'][] = trim($tag->text(true));
        }
        $this->attributes['review_tags'] = array_unique($this->attributes['review_tags']);

        $this->attributes['shipping'] = [];

        return $this;
    }

    /**
     * Get the reviews of this product.
     *
     * @return array
     */
    protected function getReviews()
    {
        $reviews = [
            'individual_stars' => [1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0]
        ];

        $ratingBox = $this->first(".ebay-review-start-rating");

        $reviews['overall_star'] = empty($ratingBox->text(true)) ? 0 : $ratingBox->text(true);
        $ratings = $this->first(".ebay-review-list")->find("li div");

        foreach ($ratings as $rating) {
            $starValue = $rating->find(".ebay-review-item-stars")[0]->text();
            $reviews['individual_stars'][$starValue] = +$rating->find(".ebay-review-item-r span")->text();
        }

        $reviews['amount'] = array_sum($reviews['individual_stars']);
        $reviews['positive'] = 0;
        $reviews['neutral'] = 0;
        $reviews['negative'] = 0;

        return $reviews;
    }

    /**
     * Attach the sales of this product to the attribute.
     *
     * @return $this
     */
    public function withSales()
    {
        $this->attributes['sales'] = scrape('ebay')->sales($this->attributes['id']);
        return $this;
    }

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return $this->attributes;
    }
}
