# 簡易管理者機能付きECサイト<br>

<img width="100%" height="1079" alt="全画面" src="https://github.com/user-attachments/assets/98b9c4eb-bcaa-4ae5-a903-22dc28b8f71c" />

## 使用した言語やツール<br>
### バックエンド<br>
PHP(Laravel/volt)<br>スターターキット Livewire
### フロントエンド<br>
HTML<br>
CSS(teilwind)<br>

### その他

#### イラスト<br>
ibisPaintX(イラストアプリ)<br>
・イラストアプリを使ってプリンのイラストを作成しました。<br>
<img width="300" height="300" alt="purin" src="https://github.com/user-attachments/assets/116bcee8-4e50-4258-9167-1c650c923bf1" /><br>

#### 画像加工<br>
フォトスケープx(画像加工アプリ)<br>
・お店のロゴ画像の切り取り、文字入れ、明るさ・サイズ調整などの簡単な操作をしました。<br>

-----------------------------------------------------------<br><br>

## サイトの構成<br>
未ログインユーザー・一般ユーザー・管理者ユーザー(マスタシーダでログイン)の3つの構成です、レスポンシブデザインにも対応しています。<br>

### 未ログインユーザー<br>
商品一覧、商品詳細、ユーザー情報の登録ページのみ権限を持ちます。<br>
### 一般ユーザー<br>
未ログインユーザーのページ含めパスワード変更、個人情報、カート、商品の購入、購入履歴の確認・操作が可能になります。<br>
### 管理者ユーザー<br>
未ログインユーザーのページ含めパスワード変更、商品の登録と論理削除、<br>販売履歴の確認・操作が可能になります。<br>
販売履歴には複数条件検索とlivewireを用いて発送状況を動的に切り替えができるように実装しました。<br>

-----------------------------------------------------------<br><br>

## ご担当者様：動作手順は下記をご覧ください<br>

### 前提条件<br>
・composer ・bun　・MySQL<br>

### 稼働方法<br>
ターミナルまたはコマンドで以下を実行してください<br>

1．任意のフォルダーにクローンしてください
```
git clone https://github.com/DinerBonbero/cakeECAdmin_portfolio2025-laravel-livewire_tailwind.git
```

2.composerとbunをインストールしてください<br>

コンポーザをインストール
```
composer install
```

bunをOSにインストール
windowsの方
```
powershell -c "irm bun.sh/install.ps1 | iex"
```
mac,Linuxの方
```
curl -fsSL https://bun.sh/install | bash
```
<br>

プロジェクトにインストールしてください
```
bun install
```
<br>

3.DBの作成<br>

MySQLにログイン
```
mysql -u root -p
```

データベース作成
```
CREATE DATABASE cakeECAdmin CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

4.マイグレートとシーダの実行
```
php artisan migrate --seed
```

5.開発サーバー起動
```
php artisan serve
```

```
bun run dev
```
-----------------------------------------------------------<br><br>

## 試行錯誤した点<br>

### 販売履歴検索画面<br>

<img width="300" height="390" alt="検索画面" src="https://github.com/user-attachments/assets/2350a144-e94f-4840-84a9-4d6c0baf0903" />

#### 検索機能をもつペジネーション<br>
・検索後に入力欄にクエリを保持する処理<br>
・検索後に検索条件を保持し続けたままページリンク先に遷移できるようにする処理<br><br>

### Livewireの使い方<br>

<img width="600" height="328" alt="発送状況" src="https://github.com/user-attachments/assets/7765f03c-5d66-47dc-a295-ee467b98b909" />

・販売履歴の発送状況(発送・未発送)を動的に切り替える(Laravelに比べ情報が少なくかなり難航しました。)<br>
・切り替えと同時に未発送であれば背景を警告色の赤色にし発送済みの時は背景色をデフォルトにする処理がかなり難しかったです。<br><br>

### 自作パスワード変更フロー<br>

<img width="300" height="216" alt="パスワード変更フロー" src="https://github.com/user-attachments/assets/8c97a39d-f86f-4589-b082-f679e522a9d9" />

・デフォルト認証画面のバリデーションに合わせて作成する時、Rules\Password::defaults()の引数がないときどのルールが適用されるかの解読に試行錯誤しました。<br><br>

### 画像登録画面の画像登録機能<br>

<img width="600" height="283" alt="商品登録画面" src="https://github.com/user-attachments/assets/c73426e7-68ef-4222-b287-457c7f251ef5" />

・商品登録での画像ファイルの扱い方を誤っていた為$_FILEではなく$_POSTのリクエストと同じ認識で躓きました。<br><br>

### 管理者権限のルートミドルウェア<br>
・当初、各画面に権限を設ける際に適切な処理がわからず、@canで画面全体を囲ってしまったり理想の処理ができていませんでした。<br><br>

### コンポーネント<br>

<img width="164" height="56" alt="ボタンコンポーネント" src="https://github.com/user-attachments/assets/254ea751-39e5-436a-97a7-f96f17809163" /><br>
※写真以外に様々なコンポーネントを作成しました

・コンポーネントの理解<br>
メリット：繰り返し使用でき、メンテナンスが用意、x-記法が周囲の方々にとって見やすい<br>
デメリット：コードが見づらくなり、解読やファイル切り替えに時間を要してしまう<br>
・コンポーネントにhref属性を渡す処理<br><br>

### viewコンポーザ<br>

<img width="778" height="200" alt="composer" src="https://github.com/user-attachments/assets/f184f2a0-b2d0-4a14-965c-ab1052c1e0d4" />

・viewコンポーザの理解が曖昧で答えの情報を得るまでに少し時間を要しました、ヘッダーコンポーネントの「ユーザー情報の設定」リンクをviewコンポーザを使用してユーザー情報の有無で遷移先を条件分岐する処理に難航しました<br>
・まだまだ未熟ですが、検索に難航したことにより「技術名」「目的」「処理内容」などで検索すると求めている情報を得やすいことがわかりました。<br>

-----------------------------------------------------------<br><br>

## 気を付けた点、意識した点<br>
・PRGパターンの意識　・N+1問題(Nが邪魔)の認識　・欠けてはならない一連の処理にトランザクションを適用<br>
・コードの一貫性と綺麗さ(現時点では未熟ですが心がけました。)








