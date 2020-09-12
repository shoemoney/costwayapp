<?php

namespace App\Listeners;

use App\Repositories\MetricsRepository;

class UpdateProductStock
{
    /**
     * Handle the event.
     *
     * @param  mixed  $event
     * @return void
     */
    public function handle($event)
    {
        app(MetricsRepository::class)->storeMany(
            $event->product,
            collect([
                'stock' => $event->stock,
            ])
        );

    }
}
