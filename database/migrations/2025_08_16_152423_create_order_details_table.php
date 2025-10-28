<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {

        Schema::create('order_details', function (Blueprint $table) {

            $table->id();
            $table->bigInteger('order_id')->index();
            $table->bigInteger('item_id')->index();
            $table->tinyInteger('item_num');
        });
    }

    public function down(): void
    {

        Schema::dropIfExists('order_details');
    }
};
