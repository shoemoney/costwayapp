<?php

namespace App\Listeners;

use App\Events\PriceChanged;

class UpdateProductPrice
{
    /**
     * Handle the event.
     *
     * @param  PriceChanged  $event
     * @return void
     */
    public function handle(PriceChanged $event)
    {
        $event->product->update([
            'price' => $event->price,
        ]);
    }
}
