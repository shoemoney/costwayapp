<?php

namespace App\Http\Controllers;

use App\Models\TrackedProduct;
use App\Http\Controllers\Controller;
use App\Http\Resources\TrackedProductResource;
use App\Http\Requests\ModifyTrackedProductRequest;
use Illuminate\Database\Eloquent\Builder;


class TrackedProductController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ModifyTrackedProductRequest $request)
    {
        return TrackedProductResource::make(
            TrackedProduct::create(
                $request->validated()
            )
        );
    }

    /**
     * Return tracked product view
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = TrackedProduct::with(
            'product',
            'product.metadata',
            'product.metrics',
        )
            ->where('user_id', auth()->user()->id)
            ->paginate();

        return view('trackedproducts.index', [
            'products' => collect($products->all()),
            'totalTracked' => $products->count(),
            'totalInStock' => app(TrackedProduct::class)->InStockCount(),
            'totaloutOfStock' => app(TrackedProduct::class)->OutOfStockCount(),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return TrackedProduct::with(
            'product',
            'product.metadata',
        )->findOrFail($id);
    }

    /**
     * Search the tracked products list
     *
     * @param  string  $store
     * @return \Illuminate\Http\Response
     */
    public function search($value)
    {
        return response()->json(
            TrackedProduct::with(
                'product',
                'product.metadata',
            )
                ->where('identifier', 'LIKE', '%' . $value . '%')
                ->orWhere('name', 'LIKE', '%' . $value . '%')
                ->orWhere('provider', $value)
                ->get()
        );
    }
}
