# Laravel Docker TODOアプリ

Laravel + Docker + MySQL + phpMyAdminで構築されたTODOアプリです。

## 特徴

- Laravel 11.x
- Docker Compose環境
- MySQL データベース
- phpMyAdmin（データベース管理）
- Bootstrap UI

## セットアップ

1. このリポジトリをクローン
```bash
git clone <your-repo-url>
cd claude-code-trial
```

2. Docker Composeでアプリを起動
```bash
docker-compose up -d
```

3. Laravelの依存関係をインストール
```bash
docker exec laravel-app composer install
```

4. 環境ファイルを設定
```bash
cp laravel-app/.env.example laravel-app/.env
```

5. アプリケーションキーを生成
```bash
docker exec laravel-app php artisan key:generate
```

6. データベースマイグレーションを実行
```bash
docker exec laravel-app php artisan migrate
```

## アクセス

- **TODOアプリ**: http://localhost
- **phpMyAdmin**: http://localhost:8080

## データベース情報

- **データベース名**: laravel
- **ユーザー名**: laravel
- **パスワード**: password

## 技術スタック

- PHP 8.2
- Laravel 11.x
- MySQL 8.0
- nginx
- Docker & Docker Compose
- Bootstrap 5.x