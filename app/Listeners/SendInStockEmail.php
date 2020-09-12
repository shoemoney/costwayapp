<?php

namespace App\Listeners;

use App\Events\InStock;
use App\Mail\InStockEmail;
use Illuminate\Support\Facades\Mail;

class SendInStockEmail
{
    /**
     * Handle the event.
     *
     * @param  StockLow  $event
     * @return void
     */
    public function handle(InStock $event)
    {
        Mail::to($event->product->user->email)
            ->send(
                new InStockEmail(
                    $event->product,
                    $event->stock
                )
            );
    }
}
