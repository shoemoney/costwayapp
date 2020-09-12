<?php

namespace App\Models\Integrations;

use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    /**
     * The model's attributes.
     *
     * @var array
     */
    protected $attributes = [
        'request_data' => "{}",
        'status_code' => 200
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'provider', 'method', 'uri', 'status_code', 'response_time', 'request_data',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'request_data' => 'array'
    ];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        // When creating the model, attach it to the currently authenticated user.
        static::creating(function ($model) {
            $model->user_id = $model->user_id ?? auth()->id();
        });
    }

    /**
     * A request can belong to a user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo("App\Models\User")->withDefault();
    }
}
