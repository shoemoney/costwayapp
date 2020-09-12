<?php

namespace App\Http\Middleware\Integrations;

use Closure;
use App\Models\Product\Sale;
use App\Repositories\ProductsRepository;

class StoreSalesResponse
{
    /** @var \App\Repositories\ProductsRepository*/
    private $productsRepository;

    public function __construct(ProductsRepository $productsRepository)
    {
        $this->productsRepository = $productsRepository;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        return $next($request);
    }

    /**
     * Handle the termination of a request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Http\Response  $response
     * @return mixed
     */
    public function terminate($request, $response)
    {
        $sales = collect($response->getData(true));
        if ($sales->count() == 0) {
            return;
        }

        $product = $this->productsRepository->lookup($sales[0]['provider'], $sales[0]['product_id']);

        if (is_null($product)) {
            return;
        }

        $sales->map(function ($sale) use ($product) {
            return Sale::updateOrCreate([
                'provider' => $sale['provider'],
                'product_id' => $product->id,
                'sold_at' => $sale['sold_at'],
            ], [
                'quantity' => $sale['quantity'],
                'price' => $sale['price']
            ]);
        });
    }
}
