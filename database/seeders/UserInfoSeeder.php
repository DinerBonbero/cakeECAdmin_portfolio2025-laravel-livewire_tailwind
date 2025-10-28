<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $useInfos = [

            ['user_id' => '2', 'last_name' => '田中', 'first_name' => 'こうた', 'phone_number' => '090-1234-5678', 'postal_code' => '012-3456', 'prefecture' => '兵庫県', 'street_address' => 'お菓子市お菓子町1-2-3', 'address_detail' => 'あまあまハイツ101'],
            //aさんのユーザー情報マスタ
            
            ['user_id' => '3', 'last_name' => '川中', 'first_name' => '悠馬', 'phone_number' => '080-1234-5678', 'postal_code' => '123-5678', 'prefecture' => '大阪府', 'street_address' => 'おごらず市焼く町3-2-1', 'address_detail' => 'お菓子メゾン1号室']
            //bさんのユーザー情報マスタ
        ];

        foreach ($useInfos as $useInfo) {
            //管理者・お客様のマスタデータの登録

            DB::table('user_infos')->insert($useInfo);
        }
    }
}
