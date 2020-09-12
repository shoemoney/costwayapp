<?php

namespace App\Listeners;

use App\Events\InStock;
use App\Repositories\ActivityRepository;

class InStockActivity
{
    /**
     * Handle the event.
     *
     * @param  SendOutOfStockEmail  $event
     * @return void
     */
    public function handle(InStock $event)
    {
        app(ActivityRepository::class)->store($event->product, [
            'action' => 'product_in_stock',
            'metadata' => [
                'product_in_stock' => "{$event->product->name} is in stock.",
                'identifier' => $event->product->identifier,
                'provider' => $event->product->provider,
            ],
        ]);
    }
}
