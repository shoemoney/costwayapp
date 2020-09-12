<?php

namespace App\Integrations\AliExpress\Responses;

use App\Integrations\Http\Response;

class GetProductResponse extends Response
{
    /**
     * Get the body attribute.
     *
     * @return mixed
     */
    public function getBody()
    {
        $body = json_decode($this->body, true);
        return $body;
    }
}
