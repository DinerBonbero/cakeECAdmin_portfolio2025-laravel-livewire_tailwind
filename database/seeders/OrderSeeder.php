<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userId = [];

        $emails = [
            'customerA@example.com',
            'customerB@example.com'
        ];

        foreach ($emails as $email) {//管理者・お客様のマスタデータの登録
            $id = DB::table('users')->where('email', $email)->value('id');//getだとコレーション(配列ではない)が返ってくるためvalueでレコードから値を取得
            $userIds[] = $id;//コレーションだとエラーになる
        }

        $orders = [
            ['user_id' => $userIds[0], 'date' => '2025-06-17', 'is_shipped' => 0],//以下2名　お客様の注文マスタデータ
            ['user_id' => $userIds[1], 'date' => '2025-08-21', 'is_shipped' => 1]
        ];


        foreach ($orders as $order) {//管理者・お客様のマスタデータの登録
            DB::table('orders')->insert($order);
        }
    }
}
