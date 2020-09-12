<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'provider', 'identifier', 'name',
    ];

    /**
     * The booting of the model.
     *
     * @return void
     */
    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->name = $model->name ?? $model->identifier;
        });
    }

    /**
     * A store has many products through the store_products table.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function products()
    {
        return $this->hasManyThrough("App\Models\Product", "App\Models\Product\StoreProduct");
    }

    /**
     * Create a watcher for the given user for this store.
     *
     * @param  \App\Models\User|null  $user
     * @return \App\Models\Store|$this
     */
    public function watchedBy(?User $user)
    {
        if (is_null($user)) {
            return $this;
        }

        $user->watch($this);
        return $this;
    }
}
