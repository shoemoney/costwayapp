<?php

namespace App\Integrations\Ebay\Requests;

use App\Integrations\Ebay\Ebay;
use App\Integrations\Http\Request;
use App\Integrations\Ebay\Responses\MostWatchedItemsByCategoryResponse;

class MostWatchedItemsByCategoryRequest extends Request
{
    /** @var string */
    protected $endpoint = "http://svcs.ebay.com/MerchandisingService";

    /** @var string */
    protected $responseHandler = MostWatchedItemsByCategoryResponse::class;

    /**
     * Build the search request with the required data.
     *
     * @param  mixed  $categoryId
     * @return \App\Integrations\Http\Response
     */
    public function search($categoryId)
    {
        return $this
            ->addData('OPERATION-NAME', 'getMostWatchedItems')
            ->addData('SERVICE-NAME', 'MerchandisingService')
            ->addData('SERVICE-VERSION', '1.1.0')
            ->addData('CONSUMER-ID', Ebay::$instance->getCredential('appId'))
            ->addData('RESPONSE-DATA-FORMAT', 'JSON')
            ->addData('GLOBAL-ID', 'EBAY-GB')
            ->addData('maxResults', Ebay::$instance->getConfig('search.items-per-page'))
            ->addData('categoryId', $categoryId)
            ->get();
    }
}
