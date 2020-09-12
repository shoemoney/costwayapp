<?php

namespace App\Mail;

use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class StockLowEmail extends Mailable
{
    use Queueable, SerializesModels;

    /** @var App\Models\Product */
    public $product;

    /** @var int */
    public $stock;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Product $product, int $stock)
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
                "Stock level is low - {$this->product->identifier}"
            )->view('emails.stocklow');

    }
}
