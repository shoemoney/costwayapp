<?php

namespace App\Models;

use App\Models\Store;
use App\Models\Product\StoreProduct;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Product extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'provider', 'identifier', 'name', 'description',
        'price', 'currency', 'user_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'price' => 'float',
    ];

    /**
     * A product has many metadata tags.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function metadata()
    {
        return $this->hasMany("App\Models\Product\Meta");
    }

    /**
     * A product has many metrics.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function metrics()
    {
        return $this->hasMany("App\Models\Product\Metric");
    }

    /**
     * Get the user who tracked the product.
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }

    /**
     * Get all of the activity for products.
     */
    public function activity()
    {
        return $this->morphMany('App\Models\Activity', 'activeable');
    }
}
