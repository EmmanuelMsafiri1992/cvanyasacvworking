<?php

namespace App;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $dates = [
        'email_verified_at',
        'package_ends_at',
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'is_admin',
        'name',
        'email',
        'email_verified_at',
        'password',
        'remember_token',
        'package_id',
        'package_ends_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_admin' => 'boolean',
    ];

    public function package()
    {
        return $this->belongsTo('App\Models\Package')->withDefault();
    }

    public function subscribed()
    {
        if (is_null($this->package_ends_at)) {
            return false;
        }

        return $this->package_ends_at->isFuture();
    }

}
