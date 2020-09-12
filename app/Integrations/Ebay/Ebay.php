<?php

namespace App\Integrations\Ebay;

use Illuminate\Support\Arr;
use App\Integrations\Ebay\ImportProvider;

class Ebay
{
    /** @var array */
    private $config = [];

    /** @var array */
    private $credentials = [];

    /** @var \App\Integrations\Ebay\Ebay */
    public static $instance;

    /**
     * Create a new instance of the Ebay Provider.
     *
     * @return void
     */
    public function __construct()
    {
        $this->config = config('ebay');
        $this->credentials = config("ebay." . config('ebay.mode') . '.credentials', []);

        static::setinstance($this);
    }

    /**
     * Get the configuration key.
     *
     * @param  string  $key
     * @return mixed
     */
    public function getConfig($key)
    {
        return Arr::get($this->config, $key);
    }

    /**
     * Get the credentials key.
     *
     * @param  string  $key
     * @return mixed
     */
    public function getCredential($key)
    {
        return Arr::get($this->credentials, $key);
    }

    /**
     * Create a new instance of the Ebay\SearchProvider.
     *
     * @return \App\Contracts\Integrations\ProductSearchInterface
     */
    public function search()
    {
        return app(SearchProvider::class, ['provider' => $this]);
    }

    /**
     * Create a new instance of the Ebay\DetailedSearchProvider.
     *
     * @return \App\Contracts\Integrations\ProductSearchInterface
     */
    public function detailedSearch()
    {
        return app(SearchProvider::class, ['provider' => $this]);
    }

    /**
     * Create a new instance of the Ebay\ProductsProvider.
     *
     * @return \App\Integrations\Ebay\ProductsProvider
     */
    public function products()
    {
        return app(ProductsProvider::class, ['provider' => $this]);
    }

    /**
     * Create a new instance of the Ebay\ImportProvider.
     *
     * @return \App\Integrations\Ebay\ImportProvider
     */
    public function import()
    {
        return app(ImportProvider::class, ['provider' => $this]);
    }

    /**
     * Create a new instance of the Ebay\CategoriesProvider.
     *
     * @return \App\Integrations\Ebay\CategoriesProvider
     */
    public function categories()
    {
        return app(CategoriesProvider::class, ['provider' => $this]);
    }

    /**
     * Set the static instance.
     *
     * @param  \App\Integrations\Ebay\Ebay  $instance
     * @return void
     */
    private static function setinstance(Ebay $instance)
    {
        static::$instance = $instance;
    }
}
