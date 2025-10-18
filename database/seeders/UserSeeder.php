<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $users = [
            ['name' => '管理者マスタ', 'email' => 'admin@example.com', 'password' => Hash::make('cakeAdmin'), 'is_admin' => 1],//管理者のマスタデータ
            ['name' => 'Aさん', 'email' => 'customerA@example.com', 'password' => Hash::make('customerA')],//以下2名　お客様のマスタデータ
            ['name' => 'Bさん', 'email' => 'customerB@example.com', 'password' => Hash::make('customerB')]
        ];

        foreach ($users as $user) {//管理者・お客様のマスタデータの登録
            DB::table('users')->insert($user);
        }
    }
}
