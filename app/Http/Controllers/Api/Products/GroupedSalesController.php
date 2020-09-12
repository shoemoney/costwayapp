<?php

namespace App\Http\Controllers\Api\Products;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Repositories\SalesRepository;
use App\Http\Resources\GroupedSaleResourceCollection;

class GroupedSalesController
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
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $productId
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $productId)
    {

        $product = Product::find($productId)
            ?? Product::where('identifier', $productId)->first();
            
        if (!$product) {
            abort(404);
        }

        return GroupedSaleResourceCollection::make(
            $this->sales->forProduct($product)
                ->where('sold_at', '>=', now()->subYear())
                ->get()
        );
    }
}
