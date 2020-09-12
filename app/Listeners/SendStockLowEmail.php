<?php

namespace App\Listeners;

use App\Events\StockLow;
use App\Mail\StockLowEmail;
use Illuminate\Support\Facades\Mail;

class SendStockLowEmail
{

    /**
     * Handle the event.
     *
     * @param  StockLow  $event
     * @return void
     */
    public function handle(StockLow $event)
    {
        Mail::to($event->product->user->email)
            ->send(
                new StockLowEmail(
                    $event->product,
                    $event->stock
                )
            );
    }
}
