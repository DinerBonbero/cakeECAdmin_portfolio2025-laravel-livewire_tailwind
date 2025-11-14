<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    protected $guarded = ['id'];

    public $timestamps = false;

    protected $casts = [

        'date' => 'datetime'
        //dateカラムをdatetime型にキャスト
        //Sailelist.blade.phpでの$saleHistory->date使用時にformatメソッドを使用可能にするため文字型からdatetime型に変換
    ];

    public function orderDetails(): HasMany
    {

        return $this->hasMany(OrderDetail::class);
    }

    public function user(): BelongsTo
    {
        
        return $this->belongsTo(User::class);
    }
}
