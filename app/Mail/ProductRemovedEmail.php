<?php

namespace App\Mail;

use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ProductRemovedEmail extends Mailable
{
    use Queueable, SerializesModels;

    /** @var App\Models\Product */
    public $product;

    /** @var string */
    public $url;

    /**
     * Create a new message instance.
     *
     * @param  \App\Models\Product
     *
     * @return void
     */
    public function __construct(Product $product, $url)
    {
        $this->product = $product;
        $this->url = $url;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(
            env('MAIL_FROM_ADDRESS')
        )
            ->subject(
                "Product has been removed! - {$this->product->identifier}"
            )->view('emails.productremoved');

    }
}
