<?php

use App\Integrations\IntegrationFactory;
use App\Scraping\ProviderFactory;

/**
 * @param  string  $provider
 * @return mixed
 */
function scrape(string $provider)
{
    return ProviderFactory::getProvider($provider);
}

/**
 * Resolve an integrations provider out of the container.
 *
 * @param  string  $provider
 * @return mixed
 */
function integration(string $provider)
{
    return app(IntegrationFactory::class)->makeProvider($provider);
}

/**
 * get the data from a url.
 *
 * @param  string $url
 * @return string
 */
function get_data($url)
{
    $ch = curl_init();
    $timeout = 5;
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
}
