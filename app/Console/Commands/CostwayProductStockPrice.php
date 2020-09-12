<?php

namespace App\Console\Commands;

use App\Events\InStock;
use App\Events\OutOfStock;
use App\Events\PriceChanged;
use App\Events\ProductRemoved;
use App\Models\TrackedProduct;
use Illuminate\Console\Command;
use App\Repositories\MetricsRepository;
use App\Repositories\ActivityRepository;
use App\Integrations\CostWay\Requests\GetProductRequest;

class CostwayProductStockPrice extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'product:costway';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update the stock or price on a product';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $products = app(TrackedProduct::class)
            ->with('product', 'product.metrics', 'user')
            ->where('provider', 'costway')
            ->get();

        $metadata = app(MetricsRepository::class);

        foreach ($products as $product) {
            $costWayProduct = app(GetProductRequest::class)->product(
                $product->identifier
            );
            $product = $product->product->first();

            if (!$costWayProduct) {
                if (!app(ActivityRepository::class)->find($product, 'product_removed') || app(ActivityRepository::class)->InStockActivityIsAboveProductRemoveActivity($product)) {
                    event(new ProductRemoved($product, "https://www.costway.co.uk"));
                }
                return false;
            }

            $costWayProductPrice = $costWayProduct['price'];
            $costWayProductStock = $costWayProduct['stock'];

            if ($costWayProductPrice != $product->price) {
                event(new PriceChanged($product, $costWayProductPrice, "https://www.costway.co.uk"));
            }

            if (
                $product->metrics->first()->value != "OutOfStock" &&
                $costWayProductStock === "OutOfStock"
            ) {
                event(new OutOfStock($product, $costWayProductStock));
            }

            if (
                $product->metrics->first()->value === "OutOfStock" &&
                $costWayProductStock != "OutOfStock"
            ) {

                event(new InStock($product, $costWayProductStock));
            }
        }

    }
}
