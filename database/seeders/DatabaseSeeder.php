<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run(): void
    {

        $this->call([

            UserSeeder::class, //ユーザのマスタシーダ
            UserInfoSeeder::class,//ユーザー情報のマスタシーダ
            ItemSeeder::class, //商品のマスタシーダ
            OrderSeeder::class, //注文と注文詳細のマスタシーダ、注文詳細シーダで分けて連動した処理での作成は不可のため一緒に作成
        ]);

        // \App\Models\User::truncate(); //レコード削除用
        // \App\Models\Order::truncate(); //レコード削除用
        // \App\Models\OrderDetail::truncate(); //レコード削除用
        // \App\Models\Cart::truncate(); //レコード削除用
        // \App\Models\Item::truncate(); //レコード削除用

        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
