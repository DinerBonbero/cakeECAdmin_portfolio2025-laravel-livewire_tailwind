<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder
{

    public function run(): void
    {

        $userIds = [];
        $orderIds = [];

        $emails = [
            'customer1@example.com',
            'customer2@example.com'
        ];

        foreach ($emails as $email) {
            
            $id = DB::table('users')->where('email', $email)->value('id');
            //Userシーダに登録したメールと一致するお客様A,Bのidを取得
            //getだとコレーション(配列ではない)が返ってくるためvalueでレコードから値を取得
            
            $userIds[] = $id; //コレーションだとエラーになる　※コレーションを入れると配列ではないためエラーなのでvalueで単一の値取得
        }

        $orders = [ //以下2名　お客様A,Bの注文マスタデータ
            ['user_id' => $userIds[0], 'date' => '2025-06-17', 'is_shipped' => 0],//'user_id'に$userIdsの0番目の値を格納
            ['user_id' => $userIds[1], 'date' => '2025-08-21', 'is_shipped' => 1]
        ];

        foreach ($orders as $order) {
            //管理者・お客様のマスタデータの登録

            $orderIds[] = DB::table('orders')->insertGetId($order);//登録したオーダーレコードのidを取得
        }

        $orderDetails = [
            ['order_id' => $orderIds[0], 'item_id' => 1, 'item_num' => 1],
            ['order_id' => $orderIds[0], 'item_id' => 6, 'item_num' => 3],
            ['order_id' => $orderIds[1], 'item_id' => 8, 'item_num' => 4],
            ['order_id' => $orderIds[0], 'item_id' => 4, 'item_num' => 2],
            ['order_id' => $orderIds[1], 'item_id' => 13, 'item_num' => 5]
        ];

        foreach ($orderDetails as $orderDetaill) {
            //管理者・お客様のマスタデータの登録
            //注文詳細シーダで分けて連動した処理での作成は不可のため一緒に作成

            DB::table('order_details')->insert($orderDetaill);
        }
    }
}
