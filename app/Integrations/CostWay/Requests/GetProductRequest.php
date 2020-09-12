<?php

namespace App\Integrations\CostWay\Requests;

use App\Integrations\Http\Request;

class GetProductRequest extends Request
{
    /** @var string */
    protected $endpoint = "https://www.costway.co.uk";
    /** @var string */
    protected $responseHandler = 'GetProductResponse::class';

    /**
     * Build the product stock request with the required data.
     *
     * @param  string  $product
     * @return \App\Integrations\Http\Response
     */
    public function product($product)
    {

        $src = get_data("{$this->endpoint}/{$product}.html");
        
        if (!$src) {
            $src = get_data("{$this->endpoint}/{$product}");
        }

        if (!$src) {
            $src = get_data("{$product}");
        }

        $src = preg_replace('/\r\n|\r|\n/', '', $src);

        // If product has been removed.
        if (strpos($src, "404 Not Found") !== false) {
            return false;
        }

        // Get product details
        preg_match_all(
            "/<script type=\"application\/ld\+json\">(.*?)<\/script>/",
            $src,
            $matches
        );
        $product = json_decode($matches[1][0], true);

        // Get product main images
        preg_match_all('/jqimg=["\']?([^"\'>]+)["\']?/', $src, $matches);
        $images = $matches[1];

        return collect([
            'title' => $product['name'] ?? null,
            'mainImage' => $product['image'] ?? null,
            'description' => $product['description'] ?? null,
            'currency' => $product['offers']['priceCurrency'] ?? null,
            'price' => (float)$product['offers']['price'] ?? null,
            'condition' => $product['offers']['itemCondition'] ?? null,
            'stock' => $product['offers']['availability'] ?? null,
            'rating' => $product['aggregateRating']['ratingValue'] ?? null,
            'reviews' => $product['aggregateRating']['reviewCount'] ?? null,
            'images' => $images,
        ]);
    }
}
