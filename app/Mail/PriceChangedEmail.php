<?php

namespace App\Mail;

use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PriceChangedEmail extends Mailable
{
    use Queueable, SerializesModels;

    /** @var App\Models\Product */
    public $product;

    /** @var int */
    public $price;

    /** @var string */
    public $url;

    /**
     * Create a new message instance.
     *
     * @param  \App\Models\Product $product
     * @param  float $price
     * @param  string $url
     *
     * @return void
     */
    public function __construct(Product $product, float $price, string $url)
    {
        $this->product = $product;
        $this->price = $price;
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
                "Price has changed - {$this->product->identifier}"
            )->view('emails.pricechanged');

    }
}
