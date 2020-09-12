<?php

namespace App\Integrations\Ebay\Requests;

use App\Integrations\Ebay\Ebay;
use App\Integrations\Ebay\Responses\SearchByKeywordResponse;
use App\Integrations\Http\Request;
use Illuminate\Support\Arr;

class SearchByKeywordRequest extends Request
{
    /** @var string */
    protected $endpoint = "https://svcs.ebay.com/services/search/FindingService/v1";

    /** @var string */
    protected $responseHandler = SearchByKeywordResponse::class;

    /**
     * Build the search request with the required data.
     *
     * @param  string  $keyword
     * @param  int  $page
     * @return \App\Integrations\Http\Response
     */
    public function search($keyword, $page)
    {
        return $this
            ->addData('OPERATION-NAME', 'findItemsByKeywords')
            ->addData('SERVICE-VERSION', '1.0.0')
            ->addData('SECURITY-APPNAME', 'JoshuaCa-producti-PRD-d5d8a3c47-edaf927d')
            ->addData('RESPONSE-DATA-FORMAT', 'JSON')
            ->addData('GLOBAL-ID', 'EBAY-GB')
            ->addData('paginationInput.entriesPerPage', Ebay::$instance->getConfig('search.items-per-page'))
            ->addData('paginationInput.pageNumber', $page)
            ->addData('keywords', urlencode($keyword))
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
