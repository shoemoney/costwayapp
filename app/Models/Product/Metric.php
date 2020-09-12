<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class Metric extends Model
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
    protected $table = "product_metrics";

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
