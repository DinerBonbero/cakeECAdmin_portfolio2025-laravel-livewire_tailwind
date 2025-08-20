<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $items =
            [
                ['image' => 'orange-cake.jpg', 'name' => 'オレンジケーキ', 'price' => 500, 'description' => '生地にオレンジの洋酒と皮を練り込み、チョコレートをコーティングしたしっとり香り高い一品です。', 'is_pending' => 0],
                ['image' => 'cherry-cake.jpg', 'name' => 'チェリーケーキ', 'price' => 450, 'description' => '古くからある家庭的なチェリーケーキです', 'is_pending' => 0],
                ['image' => 'strawberry-eclair.jpg', 'name' => '苺のエクレア', 'price' => 400, 'description' => 'フレッシュな苺と生クリームで幸せを感じます。', 'is_pending' => 0],
                ['image' => 'choco-cake.jpg', 'name' => 'チョコケーキ', 'price' => 550, 'description' => 'ほろ苦いチョコレートをあしらった、大人のケーキです。', 'is_pending' => 0],
                ['image' => 'colorful-macaroons.jpg', 'name' => 'カラフルマカロンセット', 'price' => 500, 'description' => '4種(ピスタチオ、シトロン、カカオ、苺)のマカロンです、ねっちり感のない、さっくりした生地です。', 'is_pending' => 0],
                ['image' => 'raw_chocolate-cake.jpg', 'name' => '生チョコケーキ', 'price' => 500, 'description' => 'リッチな生チョコを贅沢に使った、甘すぎないかつ苦みのある上品なチョコレートケーキです。', 'is_pending' => 0],
                ['image' => 'coffee-cupcake.jpg', 'name' => 'コーピーカップケーキ', 'price' => 300, 'description' => 'ブルーマウンテンを使ったカップケーキです。', 'is_pending' => 0],
                ['image' => 'sparkling-kiss.jpg', 'name' => 'スパークリングキッス', 'price' => 500, 'description' => '口の中で弾けるクリームをチョコレートでコーティングしました。', 'is_pending' => 0],
                ['image' => 'macarons.jpg', 'name' => 'ラズベリーのマカロン', 'price' => 350, 'description' => '沢山のフレッシュなラズベリー使用した高級マカロンです。', 'is_pending' => 0],
                ['image' => 'cheesecake.jpg', 'name' => 'チーズケーキ', 'price' => 500, 'description' => '濃厚なこだわりチーズケーキ', 'is_pending' => 0],
                ['image' => 'chicolatina.jpg', 'name' => 'ショコラティーナ', 'price' => 600, 'description' => '甘味・苦み・酸味それぞれの個性を持つ、3種類のチョコレートを使った贅沢なチョコレートケーキ', 'is_pending' => 0],
                ['image' => 'chocochip-cupcake.jpg', 'name' => 'チョコチップ', 'price' => 300, 'description' => 'チョコチップをたくさん練りこんだリッチな生地のカップケーキです。', 'is_pending' => 0],
                ['image' => 'chocolate-truffle.jpg', 'name' => 'トリュフ', 'price' => 250, 'description' => 'うまい苦みのある大人のトリュフです。', 'is_pending' => 0],
                ['image' => 'berry-cheese-cakes.jpg', 'name' => '苺のチーズケーキ', 'price' => 3600, 'description' => '3種類のベリーとさくらんぼのあっさりとしたチーズケーキです。', 'is_pending' => 0],
                ['image' => 'berry-tarte.jpg', 'name' => 'ベリータルト', 'price' => 3300, 'description' => '様々な種類のベリーをふんだんに使ったおいしいベリータルト', 'is_pending' => 0],
                ['image' => 'fruits-cake.jpg', 'name' => 'フルーツケーキホール', 'price' => 3500, 'description' => '季節のフルーツを使用した美味しいケーキです。', 'is_pending' => 0],
                ['image' => 'philadelphia.jpg', 'name' => 'フィラデルフィアホール', 'price' => 3500, 'description' => 'フィラデルフィアチーズを使ったフレッシュなチーズケーキです。', 'is_pending' => 0],
                ['image' => 'strawberry-cake.jpg', 'name' => '苺のホールケーキ', 'price' => 4000, 'description' => 'フレッシュなとれたていちごをたくさん詰め込んだ王道のケーキです。', 'is_pending' => 0],
            ];

        foreach ($items as $item) {
            DB::table('items')->insert($item);
        }
    }
}
