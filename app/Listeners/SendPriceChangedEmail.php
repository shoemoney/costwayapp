<?php

namespace App\Listeners;

use App\Events\PriceChanged;
use App\Mail\PriceChangedEmail;
use Illuminate\Support\Facades\Mail;

class SendPriceChangedEmail
{

    /**
     * Handle the event.
     *
     * @param  StockLow  $event
     * @return void
     */
    public function handle(PriceChanged $event)
    {
        Mail::to($event->product->user->email)
            ->send(
                new PriceChangedEmail(
                    $event->product,
                    $event->price,
                    $event->url
                )
            );
    }
}
