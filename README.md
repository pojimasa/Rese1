# Rese（リーズ）
<img width="1470" alt="スクリーンショット 2024-09-08 0 49 30" src="https://github.com/user-attachments/assets/2d3f35e4-d26f-46ed-8933-8acd5f638b2a">
ある会社の飲食店予約サービス
## 作成した目的
外部の飲食店予約サービスでは手数料を取られるので自社で予約サービスを持ちたい。
## アプリケーションURL
phpMyAdmin: http://localhost:8081/

開発環境： http://localhost:8080/

利用者
http://localhost:8080/register （会員登録view）

管理者
http://localhost:8080/admin/register （会員登録view）

## 機能一覧
・会員登録、ログインページではlaravelの認証機能を利用
・ログアウトしたらログインページに推移
・ユーザー情報取得
・ユーザー飲食店予約情報取得
・ユーザー飲食店お気に入り一覧取得
・飲食店一覧取得
・飲食店詳細取得
・飲食店お気に入り追加
・飲食店お気に入り削除
・飲食店予約情報追加
・飲食店予約情報削除
・エリアで検索する
・ジャンルで検索する
・店名で検索する
・FormRequestを使ったバリデーション
・予約日時または予約人数をマイページから変更
・予約したお店に来店した後に、利用者が店舗を5段階評価とコメントができる
・ブレイクポイントは768pxでレスポンシブデザイン
・店舗代表者が店舗情報の作成、更新と予約情報の確認ができる
・管理者側は店舗代表者を作成できる
・お店の画像をストレージに保存することができる（一部保存できない画像有）
・メールによって本人確認を行うことができる
・管理画面から利用者にお知らせメールを送信することができる
・タスクスケジューラーを利用して、予約当日の朝に予約情報のリマインダーを送る
・利用者が来店した際に店舗側に見せるQRコードを発行し、お店側は照合することができる
・開発環境と本番環境の切り分けを行う

## 使用技術(実行環境)
PHP 8.3.10

Laravel Framework 8.83.27

mysql 8.0.26

## テーブル設計
<img width="1465" alt="スクリーンショット 2024-09-08 0 12 08" src="https://github.com/user-attachments/assets/eae3c517-ab8c-478a-8d18-0e298da0f78c">

## ER図
<img width="524" alt="スクリーンショット 2024-09-07 23 56 30" src="https://github.com/user-attachments/assets/57689abd-0d50-4d1f-a101-78d054539ffc">

# 環境構築
　　Dockerビルド
    
1.git clone git@github.com:coachtech-material/laravel-docker-template.git

2.DockerDesktopの立ち上げ

3.docker-compose up -d --build

　　Laravel環境構築
    
1.docker-compose exec php bash(PHPコンテナ内にログイン)

2.composer install (composer.jsonに記載されたパッケージのリストをインストール)

3.cp .env.example .env(環境変数を変更)

  DB_CONNECTION=mysql/
  DB_HOST=mysql/
  DB_PORT=3306/
  DB_DATABASE=laravel_db/
  DB_USERNAME=laravel_user/
  DB_PASSWORD=laravel_pass/

4.アプリケーションキーの作成

php artisan key:generate

5.マイグレーションの実行

php artisan migrate

6.シーディングの実行

php artisan db:seed
