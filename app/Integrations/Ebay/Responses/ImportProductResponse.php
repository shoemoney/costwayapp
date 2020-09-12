<?php

namespace App\Integrations\Ebay\Responses;

use App\Integrations\Http\Response;

class ImportProductResponse extends Response
{
    /**
     * Get the body attribute.
     *
     * @return mixed
     */
    public function getBody()
    {
        $body = json_decode($this->body, true);

        dd($body);
    }
}
