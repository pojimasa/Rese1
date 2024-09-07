# Rese（リーズ）
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
