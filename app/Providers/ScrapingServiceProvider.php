<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ScrapingServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Contracts\Scraping\ClientInterface',
            'App\Scraping\HttpClient'
        );
    }
}
