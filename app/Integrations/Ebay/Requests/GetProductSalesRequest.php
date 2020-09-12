<?php

namespace App\Integrations\Ebay\Requests;

use App\Integrations\Http\Request;
use App\Integrations\Ebay\Responses\GetProductSalesResponse;

class GetProductSalesRequest extends Request
{
    /** @var string */
    protected $endpoint = "https://offer.ebay.co.uk/ws/eBayISAPI.dll?ViewBidsLogin&item=%s";

    /** @var string */
    protected $responseHandler = GetProductSalesResponse::class;

    /**
     * Request for the sales by product ID.
     *
     * @param  string  $productId
     * @return \App\Integrations\Http\Response
     */
    public function forProduct($productId)
    {
        return $this->setEndpoint(
            sprintf($this->endpoint, $productId)
        )->get();
    }
}
