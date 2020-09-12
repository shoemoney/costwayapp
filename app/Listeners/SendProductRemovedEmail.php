<?php

namespace App\Listeners;

use App\Events\ProductRemoved;
use App\Mail\ProductRemovedEmail;
use Illuminate\Support\Facades\Mail;

class SendProductRemovedEmail
{

    /**
     * Handle the event.
     *
     * @param  ProductRemoved  $event
     * @return void
     */
    public function handle(ProductRemoved $event)
    {
        Mail::to($event->product->user->email)
            ->send(
                new ProductRemovedEmail(
                    $event->product,
                    $event->url
                )
            );
    }
}
