<?php

namespace App\Concerns\Scraping;

use App\Contracts\Scraping\ClientInterface;

trait MakesRequests
{
    /** @var \App\Scraping\HttpClient */
    protected $client;

    /**
     * @return \App\Contracts\Scraping\ClientInterface
     */
    protected function httpClient(): ClientInterface
    {
        return $this->client
            ?? ($this->client = app(ClientInterface::class));
    }
}
