<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {

        Schema::create('carts', function (Blueprint $table) {

            $table->id();
            $table->bigInteger('user_id');
            $table->bigInteger('item_id');
            $table->tinyInteger('item_num')->default(1);//商品の数量　デフォルトは1
        });
    }

    public function down(): void
    {

        Schema::dropIfExists('carts');
    }
};
