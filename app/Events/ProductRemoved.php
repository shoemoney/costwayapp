<?php

namespace App\Events;

use App\Models\Product;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ProductRemoved
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /** @var \App\Models\Product */
    public $product;

    /** @var string */
    public $url;

    /**
     * Create a new event instance.
     *
     * @param  \App\Models\Product $product
     * @return void
     */
    public function __construct(Product $product, string $url)
    {
        $this->product = $product;
        $this->url = $url;
    }
}
