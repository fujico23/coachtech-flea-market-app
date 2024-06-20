# **coachtech フリマ -フリマサービスシステム-**

### coachtech フリマは coachtech ブランドのアイテムを出品するアプリです。機能や画面がシンプルで、使いやすさを重視した構成です。

## **作成した目的**

### 競合他社は機能や画面が複雑で使いづらいという調査・分析結果が出ており。独自のフリマアプリを開発することに着手することになったため

### **現状の問題**

- 機能や画面が複雑で使いづらい

### **解決方法**

- スマートフォン操作に慣れている 10~30 代の社会人が直感的に操作できるシステム

## **アプリケーション URL**

### ローカル環境：http://localhost

### 本番環境：http://00000000/

## **他のリポジトリ**

- git@github.com:fujico23/coachtech-flea-market-app.git 　より git clone

## **機能一覧**

#### 注意！！

###### ※role_id:1 は管理者、role_id:2 は利用者権限を付与

###### ※role_id 1 の場合、ヘッダーに「管理」ボタンが表示

### 【会員登録ページ】

- 会員登録ページで新規ユーザー登録
- 会員登録後、入力したメールアドレス宛に認証メールが送信される　(※後述の「メール機能の注意」参照)
- 会員登録後、商品一覧ページに遷移する
- 会員登録後、デフォルトで role_id:2 を付与

### 【ログインページ】

- ログイン後、トップページへ遷移

### 【トップページ】 ゲスト含めた全ユーザー閲覧可能(権限によって一部サービスの利用制限あり)

- 「おすすめ」は商品一覧、「マイリスト」はお気に入り登録した商品を表示(ゲストはログイン・メール未認証ユーザーは verify-email に遷移)
- メール未認証の場合、メール認証を促すモーダルウィンドウ表示

#### **■ 検索機能**

- 検索欄で商品名・カテゴリー・ブランドから検索

### 【商品詳細ページ】 ゲスト含めた全ユーザー閲覧可能(権限によって一部サービスの利用制限あり)

- ☆ マーククリックでお気に入り店舗の追加・削除(ゲストはログインページ・メール未認証ユーザーは verify-email に遷移)
- 💬 マーククリックでコメントページに遷移
- 購入するボタンで購入ページに遷移

### 【購入ページ】 ゲストは閲覧不可、メール認証未実施ユーザーは verify_email ページに遷移

#### **■Stripe 機能**

- 支払い方法　の「変更する」を押すと
- 配送先　の「変更する」を押すと「住所登録ページ」に遷移する- 支払いが完了すると Mypage の payment 項目が「paid」に変更されるが、支払い完了する前に別のページに遷移した場合「unpaid」になる

###### ※テストモードでの実装のためカード番号：4242424242424242 にてご利用下さい

### 【コメントページ】

- ☆ マーククリックでお気に入り店舗の追加・削除(ゲストはログインページ・メール未認証ユーザーは verify-email に遷移)
- 商品のコメントをしている履歴を表示
- ログインユーザーかつ、メール認証済みのユーザーはコメント追加
- 「コメントを選択する」をクリックでデフォルトメッセージから選択可
- ログインユーザー自身のコメントは削除可
- 管理者は全ユーザーのコメントを削除可

### 【Mypage ページ】 メール認証未実施ユーザーは verify_email ページに遷移

- ユーザーの「出品した商品」と「購入した商品」を表示出来る
- プロフィールを編集」ボタンを押すとプロフィール編集画面に遷移

### 【プロフィールページ】

- 各項目を更新
- プロフィール画面で入力した住所は Addresses テーブルの type カラムが「自宅」として登録

### 【配送先変更機能】

#### **住所一覧ページ**

- 現在登録されている住所一覧表示
- 配送先を選択することで Addresses テーブルの is_default カラムを切り替え、配送先を更新(購入ページにも反映される)。
- 「編集する」ボタンを押すと各住所の「編集」と「削除」ボタンが表示される
- 「新しい住所を登録する」ボタンを押すと「住所の登録」ページに遷移

#### **住所変更ページ**

- 指定した住所の各項目を編集

#### **住所追加ページ**

- 新たな住所を追加。作成されたテーブルの type カラムは「その他」として登録

### 【出品ページ】 ゲストは閲覧不可、メール認証未実施ユーザーは verify_email ページに遷移

- 出品する商品を登録出来る
- 画像は複数枚選択可

### 【管理画面】 role_id:1 のみ閲覧可

#### **admin 画面**

- アプリケーションに登録されているユーザーの一覧が表示される
- 「全ユーザーメール送信フォームへ」ボタンで全ユーザー宛のメールフォームへ遷移(※後述の「メール機能の注意」参照)
- チェックボックスで選択したユーザーを削除(複数可)

#### **ユーザー詳細 画面**

- 配送先住所登録済みの場合、配送先一覧カラムが表示され、配送先詳細を表示
- 権限を変更可能
- ユーザー毎のコメントを表示出来、この画面から、ユーザーがコメントした商品の詳細ページに遷移可。この場でコメントを削除することも可。

###### ※後述の「以下のファイルをコメントアウトしている「本番環境の場合」をご確認下さい

## **使用技術(実行環境)**

- Laravel 8.x
- PHP 7.4.9-fpm
- MySQL 8.0.26
- nginx 1.21.1

## **Laravel 環境構築**

- docker-compose up -d --build
- docker-compose exec php bash
- composer install
- .env.example ファイルから.env を作成し、環境変数を変更
- php artisan key:generate
- php artisan storage:link (開発環境でのシンボリックリンク作成コマンド)

# 過去の記述のままの項目

- php artisan schedule:work & (開発環境でのタスクスケジューラー動作確認コマンド)

#### パッケージのインストール

- composer require laravel/fortify
- php artisan vendor:publish --provider="Laravel\Fortify\FortifyServiceProvider"
- composer require laravel-lang/lang:~7.0 --dev
- cp -r ./vendor/laravel-lang/lang/src/ja ./resources/lang/

# 過去の記述のままの項目

- composer require "ext-gd:\*" --ignore-platform-reqs
- composer require simplesoftwareio/simple-qrcode
- composer require laravel/cashier

#### データ生成

##### migrate 実行コマンド

- php artisan migrate

###### seeder ファイル実行コマンド

- php artisan db:seed --class=RolesTableSeeder
- php artisan db:seed --class=UsersTableSeeder
- php artisan db:seed --class=ConditionsTableSeeder
- php artisan db:seed --class=ColorsTableSeeder
- php artisan db:seed --class=CategoriesTableSeeder
- php artisan db:seed --class=BrandsTableSeeder
- php artisan db:seed --class=DefaultCommentTableSeeder

###### Factory ファイル実行コマンド (Item)

- php artisan db:seed

## **環境変数**

### 開発環境(ローカルマシーンに Docker で環境構築)

- DB_CONNECTION=mysql
- DB_HOST=mysql
- DB_PORT=3306
- DB_DATABASE=laravel_db
- DB_USERNAME=laravel_user
- DB_PASSWORD=laravel_pass

- MAIL_FROM_ADDRESS=test@example.co.jp

### 本番環境(AWS EC2,RDS インスタンスにて構築)

###### ■RDS

- DB_CONNECTION=mysql
- DB_HOST=mysql
- DB_PORT=3306
- DB_DATABASE=RDS のデータベース名
- DB_USERNAME=RDS のユーザー名
- DB_PASSWORD=RDS のパスワード

###### ■S3

- FILESYSTEM_DRIVER=s3
- AWS_ACCESS_KEY_ID=SES の SMTP 認証情報から作成した IAM で作成したアクセスキー
- AWS_SECRET_ACCESS_KEY=SES の SMTP 認証情報から作成した IAM で作成したシークレットアクセスキー
- AWS_DEFAULT_REGION=ap-northeast-1
- AWS_BUCKET=//S3 のバケット名
- AWS_USE_PATH_STYLE_ENDPOINT=false

###### ※以下のファイルをコメントアウトしている「本番環境の場合」に変更

# 過去の記述のまま

- index.blade.php
- details.blade.php
- mypage.blade.php
- ManagementController
- AdminMailController
- ReservationReminder.php

###### ■SES

- MAIL_MAILER=ses
- MAIL_HOST=email-smtp.ap-northeast-1.amazonaws.com
- MAIL_PORT=587
- MAIL_USERNAME=SES の SMTP 認証情報から作成した IAM の SMTP ユーザー名
- MAIL_PASSWORD=SES の SMTP 認証情報から作成した IAM の SMTP パスワード
- MAIL_ENCRYPTION=tls
- MAIL_FROM_ADDRESS=SES で認証済みメールアドレス
- MAIL_FROM_NAME="${APP_NAME}"

## **テーブル設計**

![](./table.drawio.svg)

## **ER 図**

![](./er.drawio.svg)

## **他に記載することがあれば記述する**

### php artisan db:seed --class=UsersTableSeeder 実行で挿入されるユーザー

- メールアドレス：test1@example.com パスワード：11111111 (user_id:1 管理者太郎) role_id1:管理者権限 ※メールアドレス認証済みの為、認証メールは送信されません
- メールアドレス：test2@example.com パスワード：22222222 (user_id:2 利用者次郎) role_id2:利用者権限 ※メールアドレス認証済みの為、認証メールは送信されません
- メールアドレス：test3@example.com パスワード：33333333 (user_id:3 利用者三郎) role_id3:利用者権限 ※メールアドレス認証済みの為、認証メールは送信されません

### メール機能の注意点

#### 確認メール

- MustVerifyEmail インターフェースを実装しているため、登録したメールアドレスに送られる確認メールで承認しないと一部サービスの利用が制限されます。

#### 開発環境(docker Mailhog)でのメール機能注意点

- 確認メール受信確認場所 Mailhog http://localhost:8025/

#### 本番環境(AWS SES)でのメール機能注意点

- 「ドメイン取得はなし」案件の為、送信元は自身のメールアドレスにて実装。その為 DKIM 等の処理が出来ず、送信された確認メールが迷惑メール BOX に入っている可能性あり
- gmail ドメインで動作確認し、送信可能（キャリアメール、outlook では送信不可能）
- いくつかのメール機能には QR コードが添付されているが、QR コードは png 形式の画像データの為、ご利用の環境で画像が表示される設定に変更してご確認頂く必要あり(環境によってはセキュリティによって QR コードが文字化けしてしまう可能性あり)

### スプレッドシート

- https://docs.google.com/spreadsheets/d/1vAhH-4A8FhBXRyyACtWOd465NaMvdYcw5LArtchS9us/edit#gid=265853827
