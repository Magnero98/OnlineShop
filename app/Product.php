<?php

namespace Garnet;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_details')
            ->withPivot([
                'quantity',
                'created_at',
                'updated_at'
            ])
            ->withTimestamps();
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'carts')
            ->withPivot([
                'quantity',
                'created_at',
                'updated_at'
                ])
            ->withTimestamps();

    }
}
