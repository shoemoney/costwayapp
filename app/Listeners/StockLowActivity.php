<?php

namespace App\Listeners;

use App\Events\StockLow;
use App\Repositories\ActivityRepository;

class StockLowActivity
{
    /**
     * Handle the event.
     *
     * @param  StockLow  $event
     * @return void
     */
    public function handle(StockLow $event)
    {
        app(ActivityRepository::class)->store($event->product, [
            'action' => 'product_stock_low',
            'metadata' => [
                'product_stock_low' => "{$event->product->name} stock is low",
                'identifier' => $event->product->identifier,
                'provider' => $event->product->provider,
                'stock' => $event->stock,
            ],
        ]);
    }
}
