<?php

namespace App\Integrations\AliExpress\Requests;

use GuzzleHttp\Client;
use App\Integrations\Http\Request;
use App\Integrations\AliExpress\Responses\GetProductResponse;

class GetProductRequest extends Request
{
    /** @var string */
    protected $endpoint = "https://www.aliexpress.com/item/";
    /** @var string */
    protected $responseHandler = GetProductResponse::class;

    /**
     * Build the product stock request with the required data.
     *
     * @param  int  $productId
     * @return \App\Integrations\Http\Response
     */
    public function product($productId)
    {
        $client = new Client();

        $response = $client
            ->get("{$this->endpoint}/{$productId}.html")
            ->getBody()
            ->getContents();

        preg_match_all('/data: {.*/', $response, $matches);
        $new = $matches[0][0];

        preg_match_all('/{.*/', $new, $matches);

        $escaped_data = $matches[0][0];
        $escaped_data = str_replace("\u0022", "\\\"", $escaped_data);
        $escaped_data = str_replace("\u0027", "\\'", $escaped_data);
        $escaped_data = str_replace('”', '"', $escaped_data);
        $escaped_data = rtrim($escaped_data, ',');
        $product = json_decode($escaped_data);

        return collect([
            'id' => $product->actionModule->productId ?? null,
            'stock' => $product->actionModule->totalAvailQuantity ?? null,
            'categoryId' => $product->actionModule->categoryId ?? null,
            'currency' => $product->couponModule->currencyCode ?? null,
            'crossLinkGroupList' => $product->crossLinkModule->breadCrumbPathList ?? null,
            'descriptionUrl' => $product->descriptionModule->descriptionUrl ?? null,
            'images' => $product->imageModule->imagePathList ?? null,
            'description' => $product->pageModule->description ?? null,
            'mainImage' => $product->pageModule->imagePath ?? null,
            'itemUrl' => $product->pageModule->itemDetailUrl ?? null,
            'keyWords' => $product->pageModule->keywords ?? null,
            'title' => $product->pageModule->title ?? null,
            'priceModule' => [
                'discount' => $product->priceModule->discount ?? null,
                'formatedActivityPrice' => $product->priceModule->formatedActivityPrice ?? null,
                'maxActivityAmount' => (float) $product->priceModule->maxActivityAmount->value ?? null,
                'maxAmount' => (float) $product->priceModule->maxAmount->value ?? null,
            ],
            'variation' => $product->skuModule->productSKUPropertyList ?? null,
            'specsModule' => $product->specsModule->props ?? null,
            'store' => [
                'opened' => $product->storeModule->openTime ?? null,
                'lengthOpen' => $product->storeModule->openedYear ?? null,
                'positiveNum' => $product->storeModule->positiveNum ?? null,
                'positiveRate' => $product->storeModule->positiveRate ?? null,
                'name' => $product->storeModule->storeName ?? null,
                'storeUrl' => $product->storeModule->storeURL ?? null,
                'topRatedSeller' => $product->storeModule->topRatedSeller ?? null,
                'feedback' => [
                    'rating' => $product->titleModule->feedbackRating ?? null,
                ],
            ],
        ]);
    }
}
