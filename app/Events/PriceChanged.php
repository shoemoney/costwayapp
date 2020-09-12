<?php

namespace App\Events;

use App\Models\Product;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class PriceChanged
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /** @var \App\Models\Product */
    public $product;

    /** @var float */
    public $price;

    /** @var string */
    public $url;

    /**
     * Create a new event instance.
     *
     * @param  \App\Models\Product $product
     * @param  float $previous   Price
     * @return void
     */
    public function __construct(Product $product, float $price, string $url)
    {
        $this->product = $product;
        $this->price = $price;
        $this->url = $url;
    }
}
