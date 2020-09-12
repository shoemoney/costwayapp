<?php

namespace App\Integrations;

class IntegrationFactory
{
    /** @var array */
    private const PROVIDERS = [
        'ebay' => \App\Integrations\Ebay\Ebay::class,
    ];

    /**
     * Make a new instance of the requested provider.
     *
     * @param  string  $provider
     * @return
     */
    public function makeProvider($provider)
    {
        return app(
            static::PROVIDERS[$provider]
        );
    }
}
