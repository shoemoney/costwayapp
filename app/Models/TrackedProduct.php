<?php

namespace App\Models;

use App\Http\Resources\TrackedProductResource;
use App\Models\Product;
use App\Models\Store;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class TrackedProduct extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'identifier', 'provider', 'name', 'user_id',
    ];

    /**
     * Get all imported products
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function product()
    {
        return $this->hasMany(Product::class, 'identifier', 'identifier');
    }

    /**
     * Get the user who tracked the product.
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    /**
     * Create a link to the imported product
     *
     * @param  \Illuminate\Http\Array  $data
     * @return \Illuminate\Http\Response
     */
    public function createLink(array $data)
    {
        // If the product link already exists don't create a new one
        // if ($this->where('identifier', $data['identifier'])->count() > 0) {
        //     return;
        // }

        // We allow individuals to link a product, even if they don't have the product in their sellers list.
        //If there isn't a store, just make it null.
        if (empty($data['store'])) {
            $data['store'] = null;
        }

        return TrackedProductResource::make(
            $this->updateOrCreate([
                'identifier' => $data['identifier'],
            ], [
                'identifier' => $data['identifier'],
                'provider' => $data['provider'],
                'name' => $data['name'],
                'user_id' => auth()->user()->id,
            ])
        );
    }

    /**
     * Get all products in stock.
     * 
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function InStock() {
        return $this->whereHas('product.metrics', function (Builder $query) {
            $query->where('value', 'InStock');
        })->get();
    }

     /**
     * Get all products in stock count.
     * 
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function InStockCount() {
        return $this->whereHas('product.metrics', function (Builder $query) {
            $query->where('value', 'InStock');
        })->count();
    }

    /**
     * Get all products not in stock.
     * 
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function OutOfStock() {
        return $this->whereHas('product.metrics', function (Builder $query) {
            $query->where('value', 'OutOfStock');
        })->get();
    }

    /**
     * Get all products not in stock count.
     * 
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function OutOfStockCount() {
        return $this->whereHas('product.metrics', function (Builder $query) {
            $query->where('value', 'OutOfStock');
        })->count();
    }

    /**
     * Search the imported products list
     *
     * @param  string  $store
     * @return \Illuminate\Http\Response
     */
    public function search($value)
    {
        return $this->with('product', 'product.metadata', 'product.metrics')
            ->where('user_id', auth()->user()->id)
            ->orWhere('identifier', 'LIKE', '%' . $value . '%')
            ->orWhere('name', 'LIKE', '%' . $value . '%')
            ->orWhere('provider', $value)
            ->get();
    }
}
