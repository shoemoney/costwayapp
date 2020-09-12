<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class Meta extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_id', 'key', 'value'
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "product_metadata";

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'value' => 'json'
    ];

    /**
     * The product this pivots to.
     *
     * @return \Illuminate\Database\ELoquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo("App\Models\Product");
    }
}
