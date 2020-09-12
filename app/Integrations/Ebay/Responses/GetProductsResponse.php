<?php

namespace App\Integrations\Ebay\Responses;

use Illuminate\Support\Arr;
use App\Integrations\Http\Response;

class GetProductsResponse extends Response
{
    /**
     * Get the body attribute.
     *
     * @return mixed
     */
    public function getBody()
    {
        $body = json_decode($this->body, true);

        return count($body['Item']) > 1
            ? Arr::get($body, 'Item')
            : Arr::get($body, 'Item.0');
    }
}
