<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderDetail extends Model
{
    protected $guarded = ['id'];

    public $timestamps = false;

    public function order(): BelongsTo
    {

        return $this->belongsTo(Order::class);
    }

    public function item(): BelongsTo
    {
        
        return $this->belongsTo(Item::class);
    }
}
