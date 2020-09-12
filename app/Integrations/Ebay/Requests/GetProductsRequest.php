<?php

namespace App\Integrations\Ebay\Requests;

use Illuminate\Support\Arr;
use App\Integrations\Ebay\Ebay;
use App\Integrations\Http\Request;
use App\Integrations\Ebay\Responses\GetProductsResponse;

class GetProductsRequest extends Request
{
    /** @var string */
    protected $endpoint = "http://open.api.ebay.com/shopping";

    /** @var string */
    protected $responseHandler = GetProductsResponse::class;

    /**
     * Build the search request with the required data.
     *
     * @param  mixed  $productIds
     * @return \App\Integrations\Http\Response
     */
    public function search($productIds)
    {
        return $this
            ->addData('callname', 'GetMultipleItems')
            ->addData('SERVICE-NAME', 'MerchandisingService')
            ->addData('version', '967')
            ->addData('appid', Ebay::$instance->getCredential('appId'))
            ->addData('responseencoding', 'JSON')
            ->addData('GLOBAL-ID', 'EBAY-GB')
            ->addData('maxResults', Ebay::$instance->getConfig('search.items-per-page'))
            ->addData('siteid', Ebay::$instance->getConfig('siteId'))
            ->addData('ItemId', $this->convertProductIds($productIds))
            ->addData(
                'IncludeSelector',
                'Details,Description,TextDescription,ShippingCosts,ItemSpecifics,Variations,Compatibility'
            )
            ->get();
    }

    /**
     * Ensure the ItemId field is a comma-separated string.
     *
     * @param  string|array  $productIds
     * @return string
     */
    private function convertProductIds($productIds)
    {
        return implode(
            ",",
            Arr::wrap($productIds)
        );
    }
}
