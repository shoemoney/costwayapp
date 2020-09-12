<?php

namespace App\Integrations\Http;

use Exception;
use App\Integrations\Http\Request;
use GuzzleHttp\Client as HttpClient;

class Client
{
    /**
     * Send the request.
     *
     * @param  \App\Integrations\Http\Request
     * @return \App\Integrations\Http\Response
     */
    public function send(Request $request)
    {
        $client = app(HttpClient::class);

        try {
            return $client->request(
                $request->getMethod(),
                $request->getEndpoint(),
                $request->getOptions()
            );
        } catch (Exception $e) {
            return $e->getResponse();
        }
    }
}
