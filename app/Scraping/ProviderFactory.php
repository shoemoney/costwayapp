<?php

namespace App\Scraping;

use App\Scraping\Providers;

class ProviderFactory
{
    /** @var array */
    private const PROVIDERS = [
        'ebay' => Providers\Ebay::class,
    ];

    /**
     * Resolve the provider from a string identifier.
     *
     * @param  string  $provider
     * @return mixed
     */
    public static function getProvider(string $provider)
    {
        if (! array_key_exists($provider, static::PROVIDERS)) {
            throw new \Exception("Provider not found");
        }

        return app(static::PROVIDERS[$provider]);
    }
}
