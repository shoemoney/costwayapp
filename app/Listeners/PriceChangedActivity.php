<?php

namespace App\Listeners;

use App\Events\PriceChanged;
use App\Repositories\ActivityRepository;

class PriceChangedActivity
{
    /**
     * Handle the event.
     *
     * @param  PriceChanged  $event
     * @return void
     */
    public function handle(PriceChanged $event)
    {
        app(ActivityRepository::class)->store($event->product, [
            'action' => 'product_price_changed',
            'metadata' => [
                'product_price_changed' => "{$event->product->name} price has changed.",
                'identifier' => $event->product->identifier,
                'provider' => $event->product->provider,
                'previous_price' => $event->product->price,
                'new_price' => $event->price,
            ],
        ]);
    }
}
