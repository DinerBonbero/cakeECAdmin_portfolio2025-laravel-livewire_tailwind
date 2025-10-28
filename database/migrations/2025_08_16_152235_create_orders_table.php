<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {

        Schema::create('orders', function (Blueprint $table) {
            
            $table->id();
            $table->bigInteger('user_id')->index();
            $table->timestamp('date')->useCurrent()->index();//注文日時
            $table->tinyInteger('is_shipped')->default(0)->index();//発送フラグ　:0のとき未発送　:1のとき発送済み
        });
    }

    public function down(): void
    {

        Schema::dropIfExists('orders');
    }
};
