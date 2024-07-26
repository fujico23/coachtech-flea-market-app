# **coachtech フリマ -フリマサービスシステム-**

### coachtech フリマは coachtech ブランドのアイテムを出品するアプリです。機能や画面がシンプルで、使いやすさを重視した構成です。

## 目次

## 1. 作成した目的

### 競合他社は機能や画面が複雑で使いづらいという調査・分析結果が出ており、今後の競争を勝ち抜くため独自のフリマアプリを開発することに着手することになったため。スマートフォン操作に慣れている 10~30 代の社会人が直感的に操作できるシステム。

## 2. アプリケーション URL とリポジトリ

### ⅰ. アプリケーション URL

#### ローカル環境：[http://localhost](http://localhost)

###### ※Stripe 支払い機能をテストする際は https でアクセス。後述の[「6.環境構築(Stripe)」](#6環境構築stripe) のご確認下さい

#### 本番環境：[http://54.199.90.159/](http://54.199.90.159/)

### ⅱ. GitHub

#### git@github.com:fujico23/coachtech-flea-market-app.git

#### [リンク](https://github.com/fujico23/coachtech-flea-market-app.git)

## 3. 機能一覧

###### ※role_id:1 は管理者、role_id:2 は利用者権限を付与

###### ※role_id 1 の場合、ヘッダーに「管理」ボタンが表示

### 【会員登録ページ】

#### `機能1`：会員登録

- メールアドレスとパスワードを入力して会員登録

##### < その他の機能 >

- メール未認証の場合、メール認証を促すモーダルウィンドウ表示
- 会員登録後、入力したメールアドレス宛に認証メールが送信される ※後述の[「メール機能の注意」](#ⅱ-メール機能の注意点)参照

- 会員登録後、商品一覧ページに遷移する
- 会員登録後、デフォルトで role_id:2 を付与

### 【ログインページ】

#### `機能2`：ログイン

- 会員登録済みのメールアドレスとパスワードを入力してログイン
- ログイン後、トップページへ遷移

### 【トップページ】 ゲスト含めた全ユーザー閲覧可能(権限によって一部サービスの利用制限あり)

#### `機能3`：ログアウト

- ログイン後、ヘッダーに表示される「ログアウト」ボタンでログアウト

#### `機能4`、`機能5`：商品一覧取得・商品お気に入り一覧取得

- 「おすすめ」をクリックすると商品一覧表示
- 「マイリスト」をクリックするとお気に入り登録した商品を表示(ゲストはログイン・メール未認証ユーザーは verify-email に遷移)

##### < その他の機能 >

- メール未認証の場合、メール認証を促すモーダルウィンドウ表示

### 【商品詳細ページ】 ゲスト含めた全ユーザー閲覧可能(権限によって一部サービスの利用制限あり)

#### `機能6`：商品詳細取得

- 各商品の詳細を表示

#### `機能7`、`機能8`：商品お気に入り追加・削除

- ☆ マーククリックでお気に入り店舗の追加・削除(ゲストはログインページ・メール未認証ユーザーは verify-email に遷移)

##### < その他の機能 >

- 💬 マーククリックでコメントページに遷移
- 購入するボタンで購入ページに遷移

### 【コメントページ】

#### `機能9`、`機能10`：商品コメント追加・削除

- ログインユーザーかつ、メール認証済みのユーザーはコメント追加可
- 「コメントを選択する」をクリックでデフォルトメッセージから選択可
- ユーザー毎にデフォルトコメントを作成・更新可
- ログインユーザー自身のコメントは削除可

##### < その他の機能 >

- ☆ マーククリックでお気に入り店舗の追加・削除(ゲストはログインページ・メール未認証ユーザーは verify-email に遷移)
- PC の場合「コメント一覧」をホバーするとコメント一覧表示

### 【Mypage ページ】 メール認証未実施ユーザーは verify_email ページに遷移

#### `機能11`、`機能12`：ユーザー購入商品一覧取得、ユーザー出品商品一覧取得

- 「出品した商品」をクリックするとユーザーが出品した商品一覧を表示
- 「購入した商品」をクリックするとユーザーが購入した商品一覧を表示

##### < その他の機能 >

- プロフィールを編集」ボタンを押すとプロフィール編集画面に遷移

### 【プロフィールページ】

#### `機能13`：ユーザー情報取得

- 現在入力済みのユーザー名、郵便番号、住所、建物名、プロフィール画像が表示される

#### `機能14`：プロフィール変更

- 「ユーザー名」、「郵便番号」、「住所」は必須項目としてプロフィール変更
- 画像アップロードは`開発環境では src/storage/app/public/icon_image`、`本番環境では S3`にされる
- プロフィール画面で入力した住所は Addresses テーブルの type カラムが「自宅」として登録

### 【出品ページ】 ゲストは閲覧不可、メール認証未実施ユーザーは verify_email ページに遷移

#### `機能15`：出品

- 「商品の説明」以外は必須項目
- 画像アップロードは複数枚選択可であり、`開発環境では src/storage/app/public/item`、`本番環境では S3` にされる

### 【購入ページ】 ゲストは閲覧不可、メール認証未実施ユーザーは verify_email ページに遷移

#### `配送先変更機能`

##### **住所一覧ページ**

- 現在登録されている住所一覧が表示され、 配送先を選択することで Addresses テーブルの is_default カラムを切り替え、配送先を更新(購入ページにも反映される)。

##### < その他の機能 >

- 「編集する」ボタンを押すと各住所の「編集」と「削除」ボタンが表示される
- 「新しい住所を登録する」ボタンを押すと「住所の登録」ページに遷移

##### **住所変更ページ**

- 指定した住所の各項目を編集

##### **住所追加ページ**

- 新たな住所を追加し、作成されたテーブルの type カラムは「その他」として登録

#### `支払い方法の選択・変更`

- 支払い方法変更ページで「クレジットカード決済」「コンビニ払い」「銀行振り込み」が選択、更新(購入ページにも反映される)

#### `商品購入機能(Stripe)`

- 支払い方法の「変更する」を押すと支払い方法に応じた Stripe オブジェクトを生成
- 支払いが完了すると orders テーブルの status が「クレジット決済」の場合は 3、「コンビニ払い」「銀行振り込み」の場合は 2 に変更される

###### ※テストモードでの実装のため、クレジットカード決済の場合はカード番号：4242424242424242 にてご利用下さい

###### ※Webhook を利用してるため、https に変更する必要あり※後述の[「6.環境構築(Stripe)」](#6環境構築stripe) のご確認下さい

### 【管理画面】 role_id:1 のみ閲覧可

#### `管理画面-ユーザーの削除`

- チェックボックスで選択したユーザーを削除(複数可)

#### `メール送信`

- 「全ユーザーメール送信フォームへ」ボタンで全ユーザー宛のメールフォームへ遷移(※後述の「メール機能の注意」参照)

##### < その他の機能 >

- 会員登録済みのユーザーの一覧が表示され、「詳細」をクリックすると各ユーザー詳細画面に遷移

#### **ユーザー詳細 画面**

#### `管理画面-一般ユーザーのコメントを削除`

- ユーザー毎のコメントを表示しコメントを削除可

#### `メール送信`

- 「個人メールフォームへ」ボタンで全ユーザー宛のメールフォームへ遷移※後述の[「メール機能の注意」](#ⅱ-メール機能の注意点)参照

##### < その他の機能 >

- 配送先住所登録済みの場合、配送先一覧カラムが表示され、配送先詳細を表示
- 権限を変更可能

## 4. 実行環境

### i. 使用技術

- Laravel 8.x
- PHP 7.4.9-fpm
- MySQL 8.0.26
- nginx 1.21.1

### ⅱ. パッケージ

<details>
<summary>閲覧</summary>
■composer require laravel/fortify
■php artisan vendor:publish--provider="Laravel\Fortify\FortifyServiceProvider"
■composer require laravel-lang/lang:~7.0 --dev
■cp -r ./vendor/laravel-lang/lang/src/ja ./resources/lang/
■composer require laravel/cashier
■composer require intervention/image:^2
</details>

## 5. 環境構築（Laravel)

### i. コマンドの実行

**※GitHub にて新しくリモートリポジトリを作成した前提です**

#### a. リポジトリの設定

```bash
git clone git@github.com:fujico23/coachtech-flea-market-app.git
cd coachtech-flea-market-app
git remote set-url origin 作成したリポジトリの url
git remote -v #任意。作成したリポジトリのurlが表示されていれば成功
```

#### ※エラーが発生する場合は以下のコマンドを実行

```bash
sudo chmod -R 777 *
```

#### Docker の設定

```bash
docker-compose up -d --build
```

#### Laravel のパッケージのインストール

```bash
docker-compose exec php bash
composer install
```

#### .env ファイルの生成　※後述[「ⅲ,環境変数 a.開発環境」](#a-開発環境)参照

```bash
cp .env.example .env
```

#### 各種設定

```bash
docker-compose exec php bash
```

#### アプリケーションキー生成

```bash
php artisan key:generate
```

#### 初期データ生成

```bash
php artisan migrate:reset
php artisan migrate
php artisan db:seed
```

#### シンボリックリンク生成

```bash
php artisan storage:link
```

### ⅲ. 環境変数

#### a. 開発環境

```bash
APP_NAME=coachtech-flea-market-app
APP_ENV=local
APP_KEY=base64:XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX #php artisan key:generate後に自動的に挿入される
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel_db
DB_USERNAME=laravel_user
DB_PASSWORD=laravel_pass

FILESYSTEM_DRIVER=local

MAIL_MAILER=smtp
MAIL_HOST=mailhog
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=coachtech-flea-market-app@example.com
MAIL_FROM_NAME="${APP_NAME}"
```

#### b. テスト環境　※後述[「7. PHPUnit テスト」](#7-phpunit-テスト)参照

```bash
APP_ENV=testing
```

#### c. 本番環境(AWS EC2,RDS,S3,SES)

```bash
APP_NAME=coachtech-flea-market-app
APP_ENV=production
APP_DEBUG=false
APP_URL=http://54.199.90.159/

DB_CONNECTION=mysql
DB_HOST=#RDS のエンドポイント
DB_PORT=3306
DB_DATABASE=#RDS のデータベース名
DB_USERNAME=#RDS のユーザー名
DB_PASSWORD=#RDS のパスワード

FILESYSTEM_DRIVER=s3

MAIL_MAILER=ses
MAIL_HOST=email-smtp.ap-northeast-1.amazonaws.com
MAIL_PORT=587
MAIL_USERNAME=#SES の SMTP 認証情報から作成した IAM の SMTP ユーザー名
MAIL_PASSWORD=#SES の SMTP 認証情報から作成した IAM の SMTP パスワード
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=#SES で認証済みメールアドレス
MAIL_FROM_NAME="${APP_NAME}"

AWS_ACCESS_KEY_ID=#SES の SMTP 認証情報から作成した IAM で作成したアクセスキー
AWS_SECRET_ACCESS_KEY=#SES の SMTP 認証情報から作成した IAM で作成したシークレットアクセスキー
AWS_DEFAULT_REGION=ap-northeast-1
AWS_BUCKET=#S3 のバケット名
AWS_USE_PATH_STYLE_ENDPOINT=false
```

### ⅳ. 動作確認

[http://localhost](http://localhost)にアクセス出来る確認し、アプリケーションが表示されていれば成功。

## 6.環境構築(Stripe)

### i. `ngrok` による HTTPS 通信環境構築

#### Stripe の Webhook を設定するために、一時的に HTTPS 通信の環境を構築する。

#### a. [ngrok](https://ngrok.com/) にサインイン後、AuthToken 取得

#### b. ターミナルで ngrok コンテナを生成する

```bash
docker pull ngrok/ngrok
docker run --net=host -it -e NGROK_AUTHTOKEN=[your AuthToken] ngrok/ngrok:latest http 80
#your AuthTokenは取得した値を入力
```

#### c. ngrok の**Endpoits**ページに移動し個別の httpsURL を取得

#### 例:***https://XXXX-XXX-XXX-XX-XX.ngrok-free.app***

### ⅱ. `Stripe` による環境構築

#### a. [Stripe](https://stripe.com/jp?utm_campaign=JP_JA_Search_Brand_Payments-Pure_EXA-21278920274&utm_medium=cpc&utm_source=google&ad_content=699150004484&utm_term=stripe&utm_matchtype=e&utm_adposition=&utm_device=c&gad_source=1&gclid=CjwKCAjwqMO0BhA8EiwAFTLgIECq-A7jSm9sy8yCXauKjDMUICOGZ4kN0P3GdRbS4g4aTXnYNW1lJhoCvjEQAvD_BwE) にサインイン後、開発者ページ > Webhook > エンドポイントを追加に遷移し設定

#### b. エンドポイント URL に ngrok で取得した URL を参考に***https://XXXX-XXX-XXX-XX-XX.ngrok-free.app***/stripe/webhook と入力

#### c. イベント追加に「invoice.payment_action_required」「cancelcustomer.deleted」、「cancelcustomer.updated」、「cancelcustomer.subscription.deleted」、「cancel customer.subscription.updated」、「cancel customer.subscription.created」、「cancel checkout.session.completed」、「cancel payment_intent.succeeded」、「cancel payment_intent.payment_failed」を追加し、エンドポイントを更新

### ⅲ. `Laravel` による環境構築

##### a. `環境変数`の変更

###### Stripe にサインイン後、開発者ページ > API キーに遷移し、「公開可能キー」「シークレットキー」を取得

###### Stripe にサインイン後、開発者ページ > Webhook > 先ほど追加したエンドポイント　に遷移し、「署名シークレット」を取得

```bash
STRIPE_KEY=#stripe の公開可能キー
STRIPE_SECRET=#stripe のシークレットキー
STRIPE_WEBHOOK=#stripe の追加したエンドポイントの署名シークレット
```

##### b. [AppServiceProvider.php](/src/app/Providers/AppServiceProvider.php) ファイル

「//https 通信では以下有効」直下のコメントアウトを有効にする

## 7. PHPUnit テスト

### [phpunit.xml ファイル](/src/phpunit.xml) の「テスト時は以下のコメントアウトを有効にする」以下のコードを有効にする

```bash
php artisan test
```

## 8. Circle CI

### ⅰ. 環境構築

#### [config.yml](/.circleci/config.yml)

#### [appspec.yml](/appspec.yml)

### ⅱ. 実行コマンド

#### 通常通り git push まで実行

```bash
git add .
git commit -m"任意のメッセージ"
git push origin main
```

## 9. テーブル設計

![](./table.drawio.svg)

## 10. ER 図

![](./er.drawio.svg)

## 11. その他

### ⅰ. `UsersTableSeeder` の初期ユーザーデーター

- メールアドレス：test1@example.com パスワード：11111111 (user_id:1 管理者太郎) role_id1:管理者権限 ※メールアドレス認証済みの為、認証メールは送信されません
- メールアドレス：test2@example.com パスワード：22222222 (user_id:2 利用者次郎) role_id2:利用者権限 ※メールアドレス認証済みの為、認証メールは送信されません
- メールアドレス：test3@example.com パスワード：33333333 (user_id:3 利用者三郎) role_id3:利用者権限 ※メールアドレス認証済みの為、認証メールは送信されません

### ⅱ. メール機能の注意点

#### a. 確認メール

- MustVerifyEmail インターフェースを実装しているため、登録したメールアドレスに送られる確認メールで承認しないと一部サービスの利用が制限されます。

#### b. 開発環境(Mailhog)でのメール機能注意点

- 確認メール受信確認場所 Mailhog [http://localhost:8025/](http://localhost:8025/)

#### c. 本番環境(AWS SES)でのメール機能注意点

- 「ドメイン取得はなし」案件の為、送信元は自身のメールアドレスにて実装。その為 DKIM 等の処理が出来ず、送信された確認メールが迷惑メール BOX に入っている可能性あり
- gmail ドメインで動作確認し、送信可能（キャリアメール、outlook では送信不可能）

### ⅲ. スプレッドシート

- https://docs.google.com/spreadsheets/d/1vAhH-4A8FhBXRyyACtWOd465NaMvdYcw5LArtchS9us/edit#gid=265853827
