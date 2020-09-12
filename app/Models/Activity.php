<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'activeable_id', 'activeable_type', 'action', 'metadata'
    ];

    /**
     * Get the owning activeable model.
     */
    public function activeable()
    {
        return $this->morphTo();
    }
}
