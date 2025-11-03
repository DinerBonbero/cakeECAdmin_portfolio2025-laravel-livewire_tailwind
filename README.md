# 簡易管理者機能付きECサイト<br>

<img width="100%" height="1079" alt="全画面" src="https://github.com/user-attachments/assets/98b9c4eb-bcaa-4ae5-a903-22dc28b8f71c" />

## アプリの説明<br>
レスポンシブデザインにも対応した簡易的な管理者機能付きの模擬ケーキ屋ECサイトです。<br>
### 機能
ゲストは商品の閲覧のみができ、一般ログインユーザーは商品の閲覧に加え商品の購入や購入履歴の表示ができます。<br>
管理者アカウントは商品の閲覧と商品の掲載停止(論理削除)、商品登録、販売履歴の一覧表示と<br>
複数検索(発送状況,表示する期間,購入者名)による絞り込みや発送状況の切り替え(発送済み,未発送)ができます。<br>
管理者アカウントはあらかじめマスタシーダで登録したメールアドレスとパスワードでログインします。<br><br>

| ユーザー種別     | 商品閲覧 | 商品購入 | 購入履歴 | 商品登録 | 掲載停止(論理削除) | 販売履歴 | 絞り込み検索 | 発送状況切替 |
|------------------|----------|----------|----------|----------|----------|----------|----------------|----------------|
| ゲスト           | ✅       | ❌       | ❌       | ❌       | ❌       | ❌       | ❌              | ❌              |
| 一般ユーザー     | ✅       | ✅       | ✅       | ❌       | ❌       | ❌       | ❌              | ❌              |
| 管理者           | ✅       | ❌       | ❌       | ✅       | ✅       | ✅       | ✅              | ✅              |

<br>

## 使用した言語やツール<br>
xamppを使って実装させていただきました。<br>

PHP　8.2(Laravel 12.0)<br>
Tailwind CSS ^4.0.7<br>
Livewire 3.6.4<br>

### データベース<br>
MariaDB 10.4.32<br>

### webサーバー
Apach 2.4.58<br>

### パッケージマネージャー<br>
bun 1.2.15<br>
※npmの代替にあたる[Bun](https://bun.sh/) を使用しています。<br>
Node.jsでは複数のツールを組み合わせる必要がありますが、BunはJavaScriptランタイム／ビルダー／テストランナー/パッケージマネージャーが一つにまとめられている為、<br>
npmやyarnと比べインストールや起動,実行などの動作速度が高速です。<br>

### イラスト<br>
ibisPaintX(イラストアプリ)<br>
・イラストアプリを使ってプリンのイラストを作成しました。<br>
<img width="300" height="300" alt="purin" src="https://github.com/user-attachments/assets/116bcee8-4e50-4258-9167-1c650c923bf1" /><br>

### 画像加工<br>
フォトスケープx(画像加工アプリ)<br>
・お店のロゴ画像の切り取り、文字入れ、明るさ<br>
・サイズ調整などの簡単な操作をしました。<br>

-----------------------------------------------------------<br><br>

## 動作手順は下記をご覧ください<br>
本プロジェクトでは、わたくし自身はbunとXAMPPのMariaDBを使用して開発しましたが、こちらでは手軽なnpmとSQLiteでの動作を前提とした手順を記載させていただきます。<br>
なおNode.jsはインストールしているものとします。

### 稼働方法<br>
ターミナルまたはコマンドプロンプトで以下を実行してください<br>

1．プロジェクトをフォルダー「test」にクローンしてください
```
git clone https://github.com/DinerBonbero/cakeECAdmin_portfolio2025-laravel-livewire_tailwind.git
```

2.クローンした「cakeECAdmin_portfolio2025-laravel-livewire_tailwind.git」にカレントディレクトリを合わせてください<br>

プロジェクトにPHPの依存関係をインストールしてください
```
composer install
```

プロジェクトにJavaScriptパッケージをインストールしてください
```
npm install
```
<br>

3.cakeECAdminという名前のDBを作成してください<br>

MySQLにログイン
```
mysql -u root -p
```

データベース作成
```
CREATE DATABASE cakeECAdmin CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

4.マイグレーションとシーダの実行をしてください
```
php artisan migrate --seed
```
※下記のレコードをインサートします。<br>
usersテーブルは管理者1名とお客様2名のレコード<br>
user_infoテーブルはお客様2名のレコード<br>
itemsテーブルは各商品のレコード<br>
ordersテーブルにお客様の注文レコード<br>
order_detailsテーブルに注文レコードに対応した注文詳細のレコード<br>

5.シンボリックリンクを設定してください
```
php artisan storage:link
```
設定後はdoc/商品画像の中にある全ファイルをstorage/app/public/imagesのフォルダ内に貼り付けてください<br>

6.開発サーバーを起動してください
```
php artisan serve
```

```
bun run dev
```
※マスタシーダでログインされる際はこちらのメールとパスポートでログインできます<br>

| ユーザー      | メール                       | パスワード      | 
|--------------|------------------------------|----------------|
| 管理者        | admin@example.com           | cakeAdmin       |
| お客様A       | customer1@example.com       | customer1       |
| お客様B       | customer2@example.com       | customer2       |

-----------------------------------------------------------<br><br>

## 気を付けた点、意識した点<br>
・PRGパターンの意識<br>
・N+1問題(Nが邪魔)の認識<br>
・欠けてはならない一連の処理にトランザクションを適用<br>
・コードの一貫性と綺麗さ(現時点では未熟ですが心がけました。)



























