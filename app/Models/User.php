<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * A user can watch models.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function watching()
    {
        return $this->hasMany("App\Models\Watcher");
    }

    /**
     * Watch a new watchable entity.
     *
     * @param  mixed  $watchable
     * @return \App\Models\User\Watcher
     */
    public function watch($watchable)
    {
        return $this->watching()
            ->firstOrCreate([
                'watchable_type' => get_class($watchable),
                'watchable_id' => $watchable->id
            ]);
    }
}
