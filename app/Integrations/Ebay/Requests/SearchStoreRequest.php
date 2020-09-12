<?php

namespace App\Integrations\Ebay\Requests;

use Illuminate\Support\Arr;
use App\Integrations\Ebay\Ebay;
use App\Integrations\Http\Request;
use App\Integrations\Ebay\Responses\SearchStoreResponse;

class SearchStoreRequest extends Request
{
    /** @var string */
    protected $endpoint = "https://svcs.ebay.com/services/search/FindingService/v1";

    /** @var string */
    protected $responseHandler = SearchStoreResponse::class;

    /**
     * Build the search request with the required data.
     *
     * @param  string  $identifier
     * @param  int  $page
     * @return \App\Integrations\Http\Response
     */
    public function search($identifier, $page)
    {
        return $this
            ->addData('OPERATION-NAME', 'findItemsAdvanced')
            ->addData('SERVICE-VERSION', '1.0.0')
            ->addData('SECURITY-APPNAME', Ebay::$instance->getCredential('appId'))
            ->addData('RESPONSE-DATA-FORMAT', 'JSON')
            ->addData('GLOBAL-ID', 'EBAY-GB')
            ->addData('paginationInput.entriesPerPage', Ebay::$instance->getConfig('search.items-per-page'))
            ->addData('paginationInput.pageNumber', $page)
            ->addData('outputSelector', 'SellerInfo')
            ->addData('itemFilter(0).name', 'Seller')
            ->addData('itemFilter(0).value', $identifier)
            ->get();
    }

    /**
     * Attach the data attribute to the request.
     *
     * @return \App\Integrations\Http\Request|$this
     */
    protected function attachData(): Request
    {
        $data = collect(Arr::dot($this->data))
            ->map(function ($value, $key) {
                return "{$key}={$value}";
            })
            ->values()
            ->implode('&');

        $this->appendToEndpoint("?{$data}");

        return $this;
    }
}
