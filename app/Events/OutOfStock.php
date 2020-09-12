<?php

namespace App\Events;

use App\Models\Product;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class OutOfStock
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /** @var \App\Models\Product */
    public $product;

    /** @var int */
    public $stock;

    /**
     * Create a new event instance.
     *
     * @param  \App\Models\Product $product
     * @param  int|string $stock
     * @return void
     */
    public function __construct(Product $product, $stock)
    {
        $this->product = $product;
        $this->stock = $stock;
    }
}
