<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Item extends Model
{
    protected $guarded = ['id'];

    public function carts(): HasMany
    {
        return $this->hasMany(Cart::class);
    }
    
    public function order_details(): HasMany
    {
        return $this->hasMany(OrderDetail::class);
    }
}
