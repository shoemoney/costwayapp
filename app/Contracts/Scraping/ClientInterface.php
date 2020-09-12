<?php

namespace App\Contracts\Scraping;

interface ClientInterface
{
    /**
     * Handle the request.
     *
     * @var  array  $options
     * @return string
     */
    public function handle($options = []): string;
}
