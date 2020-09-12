<?php

namespace App\Listeners;

use App\Events\OutOfStock;
use App\Mail\OutOfStockEmail;
use Illuminate\Support\Facades\Mail;

class SendOutOfStockEmail
{

    /**
     * Handle the event.
     *
     * @param  StockLow  $event
     * @return void
     */
    public function handle(OutOfStock $event)
    {
        Mail::to($event->product->user->email)
            ->send(
                new OutOfStockEmail(
                    $event->product,
                    $event->stock
                )
            );
    }
}
