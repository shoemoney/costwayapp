<?php

namespace App\Listeners;

use App\Events\ProductRemoved;
use App\Repositories\ActivityRepository;

class ProductRemovedActivity
{
    /**
     * Handle the event.
     *
     * @param  StockLow  $event
     * @return void
     */
    public function handle(ProductRemoved $event)
    {
        app(ActivityRepository::class)->store($event->product, [
            'action' => 'product_removed',
            'metadata' => [
                'product_removed' => "{$event->product->name} has been removed.",
                'identifier' => $event->product->identifier,
                'provider' => $event->product->provider
            ],
        ]);
    }
}
