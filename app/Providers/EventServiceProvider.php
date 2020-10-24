<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        "Illuminate\Auth\Events\Registered" => [
            "Illuminate\Auth\Listeners\SendEmailVerificationNotification",
        ],

        'App\Events\Integrations\RequestMade' => [

        ],

        'App\Events\StockLow' => [
            'App\Listeners\SendStockLowEmail',
            'App\Listeners\StockLowActivity',
            'App\Listeners\UpdateProductStock',
        ],

        'App\Events\InStock' => [
            'App\Listeners\SendInStockEmail',
            'App\Listeners\UpdateProductStock',
            'App\Listeners\InStockActivity',
        ],

        'App\Events\OutOfStock' => [
            'App\Listeners\SendOutOfStockEmail',
            'App\Listeners\UpdateProductStock',
            'App\Listeners\OutOfStockActivity',

        ],

        'App\Events\PriceChanged' => [
            'App\Listeners\SendPriceChangedEmail',
            'App\Listeners\PriceChangedActivity',
            'App\Listeners\UpdateProductPrice',
        ],

        'App\Events\ProductRemoved' => [
           // 'App\Listeners\SendProductRemovedEmail',
            'App\Listeners\ProductRemovedActivity',
        ],
    ];
}
