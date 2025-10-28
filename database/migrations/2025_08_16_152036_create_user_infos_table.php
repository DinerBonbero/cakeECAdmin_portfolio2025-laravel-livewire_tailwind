<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {

        Schema::create('user_infos', function (Blueprint $table) {

            $table->id();
            $table->bigInteger('user_id')->unique();
            $table->string('last_name', length: 30);
            $table->string('first_name', length: 30);
            $table->string('phone_number', length: 14);
            $table->string('postal_code', length: 8);
            $table->string('prefecture', length: 4);
            $table->string('street_address', length: 50);
            $table->string('address_detail', length: 50)->nullable();
        });
    }

    public function down(): void
    {
        
        Schema::dropIfExists('user_infos');
    }
};
