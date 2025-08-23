<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            OrderSeeder::class,
            //ItemSeeder::class,//商品のマスタシーダ
        ]);

        // \App\Models\User::truncate();//レコード削除用
        // \App\Models\Order::truncate();//レコード削除用
        // \App\Models\OrderDetail::truncate();//レコード削除用

        // User::factory(10)->create();

        //User::factory()->create([
        //    'name' => 'Test User',
        //    'email' => 'test@example.com',
        //]);
    }
}
