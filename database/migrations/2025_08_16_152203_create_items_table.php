<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {

        Schema::create('items', function (Blueprint $table) {

            $table->id();
            $table->string('image', length: 30);
            $table->string('name', length: 15);
            $table->mediumInteger('price');
            $table->string('description', length: 50);
            $table->tinyInteger('is_pending')->default(0); //販売停止フラグ　:0のとき販売中　:1のとき販売停止
        });
    }

    public function down(): void
    {

        Schema::dropIfExists('items');
    }
};
