<?php

namespace App\Http\Controllers\CostWay;

use App\Integrations\CostWay\Requests\GetProductRequest;
use App\Models\Product;
use App\Models\TrackedProduct;
use App\Repositories\MetadataRepository;
use App\Repositories\MetricsRepository;
use Illuminate\Http\Request;

class ProductController
{

    /** @var string */
    protected $endpoint = "https://www.costway.co.uk";
    /**
     * Add product form
     *
     */
    public function index()
    {
        return view('product.costway.index');
    }

    /**
     * Show the CostWay product Details
     *
     * @param  string  $product
     * @return \Illuminate\Http\Response
     */
    public function show($product)
    {
        return response()->json(app(GetProductRequest::class)->product($product));
    }

    /**
     * Store the product
     *
     * @param  int  $productId
     * @return \Illuminate\Http\Reques
     */
    public function store(Request $request)
    {
        $request->validate([
            'identifier' => 'required',
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'currency' => 'required',
            'images' => 'required',
            'stock' => 'required',
        ]);

        $product = Product::updateOrCreate([
            'identifier' => $request->get('identifier'),
        ], [
            'provider' => "costway",
            'identifier' => $request->get('identifier'),
            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'price' => $request->get('price'),
            'currency' => $request->get('currency'),
            'user_id' => auth()->user()->id,
        ]);

        app(MetadataRepository::class)->storeMany($product, collect(
            [
                'images' => $request->get('images'),
                'url' => "{$this->endpoint}/{$request->get('identifier')}.html",
                'rating' => $request->get('rating') ?? 0,
                'reviews' => $request->get('reviews') ?? 0,
            ]
        ));

        app(MetricsRepository::class)->storeMany($product, collect(
            [
                'stock' => $request->get('stock'),
            ]
        ));

        app(TrackedProduct::class)->createLink([
            'identifier' => $request->get('identifier'),
            'name' => $request->get('name'),
            'provider' => 'costway',
        ]);
    }
}
