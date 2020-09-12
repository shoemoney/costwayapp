<?php

namespace App\Integrations\Ebay;

use App\Integrations\Ebay\Ebay;

abstract class Provider
{
    /** @var \App\Integrations\Ebay\Ebay */
    protected $provider;

    /**
     * Create a new instance of the SearchProvider.
     *
     * @param  \App\Integrations\Ebay\Ebay  $provider
     * @return void
     */
    public function __construct(Ebay $provider)
    {
        $this->provider = $provider;
    }
}
