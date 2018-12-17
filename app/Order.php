<?php

namespace Garnet;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_details')
            ->withPivot([
                'quantity',
                'created_at',
                'updated_at'
            ])
            ->withTimestamps();
    }
}
