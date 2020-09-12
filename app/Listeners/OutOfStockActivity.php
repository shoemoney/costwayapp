<?php

namespace App\Listeners;

use App\Events\OutOfStock;
use App\Repositories\ActivityRepository;

class OutOfStockActivity
{
    /**
     * Handle the event.
     *
     * @param  SendOutOfStockEmail  $event
     * @return void
     */
    public function handle(OutOfStock $event)
    {
        app(ActivityRepository::class)->store($event->product, [
            'action' => 'product_out_of_stock',
            'metadata' => [
                'product_out_of_stock' => "{$event->product->name} is out of stock.",
                'identifier' => $event->product->identifier,
                'provider' => $event->product->provider,
            ],
        ]);
    }
}
