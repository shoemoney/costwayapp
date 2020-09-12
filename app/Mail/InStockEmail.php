<?php

namespace App\Mail;

use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InStockEmail extends Mailable
{
    use Queueable, SerializesModels;

    /** @var App\Models\Product */
    public $product;

    /** @var int */
    public $stock;

    /**
     * Create a new message instance.
     *
     * @param  \App\Models\Product
     * @param int|string $stock
     *
     * @return void
     */
    public function __construct(Product $product, $stock)
    {
        $this->product = $product;
        $this->stock = $stock;
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
                "Product is back Stock! - {$this->product->identifier}"
            )->view('emails.instock');

    }
}
