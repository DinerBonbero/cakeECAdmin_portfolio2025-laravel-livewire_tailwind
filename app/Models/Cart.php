<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cart extends Model
{
    protected $guarded = ['id'];
    //idの保護

    public $timestamps = false;
    //Laravelでは自動でcreated_atとupdated_atが記録される、今回のカートテーブルは取り扱わないためLaravelに自動処理をさせない処理

    public function user(): BelongsTo
    {

        return $this->belongsTo(User::class);
    }

    public function item(): BelongsTo
    {
        
        return $this->belongsTo(Item::class);
    }
}
