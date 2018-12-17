<?php

namespace Garnet;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'image', 'role_id', 'name', 'gender', 'email', 'password', 'dateOfBirth',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'carts')
            ->withPivot([
                'quantity',
                'created_at',
                'updated_at'
            ])
            ->orderBy('created_at', 'ASC')
            ->withTimestamps();
    }
}
