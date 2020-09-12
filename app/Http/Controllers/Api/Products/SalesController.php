<?php

namespace App\Http\Controllers\Api\Products;

use App\Models\Product;
use App\Models\Product\Sale;
use Illuminate\Http\Request;
use App\Http\Resources\SaleResource;
use App\Repositories\SalesRepository;
use App\Http\Requests\ModifySaleRequest;
use App\Http\Requests\StoreSalesRequest;

class SalesController
{
    /** @var \App\Repositories\SalesRepository */
    private $sales;

    /**
     * Create a new instance of the controller.
     *
     * @param  \App\Repositories\SalesRepository  $sales
     * @return void
     */
    public function __construct(SalesRepository $sales)
    {
        $this->sales = $sales;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  int  $productId
     * @return \Illuminate\Http\Response
     */
    public function index($productId)
    {
        $product = Product::findOrFail($productId);

        return SaleResource::collection(
            $this->sales->forProduct($product)->latest()->paginate()
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $productId
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSalesRequest $request, $productId)
    {
        $product = Product::findOrFail($productId);

        return SalesResource::collection(
            $this->sales->storeMany($product, $request->sales())
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $productId
     * @param  \App\Models\Products\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function show($productId, Sale $sale)
    {
        $product = Product::findOrFail($productId);

        if (is_null($sale) || $sale->product_id !== $product->id) {
            abort(404);
        }

        return SaleResource::make(
            $sale
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $productId
     * @param  \App\Models\Products\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function update(ModifySaleRequest $request, $productId, Sale $sale)
    {
        $product = Product::findOrFail($productId);

        if (is_null($sale) || $sale->product_id !== $product->id) {
            abort(404);
        }

        $sale->update($request->validated());

        return SaleResource::make(
            $sale
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $productId
     * @param  \App\Models\Products\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function destroy($productId, Sale $sale)
    {
        $product = Product::findOrFail($productId);

        if (is_null($sale) || $sale->product_id !== $product->id) {
            abort(404);
        }

        $sale->delete();

        return SaleResource::make(
            $sale
        );
    }
}
