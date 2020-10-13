# Kpchat

## Requirements

- Composer
- Laravel 8.x
- PHP >= 7.3
- MySQL 5.6+
- Node 6.0+ (for laravel-echo-server)
- Redis 3+ (for laravel-echo-server)

## Install

    composer install

## Run

    php artisan serve

## Database

Create a user with appropriate privileges and then run:

    CREATE DATABASE kpchat CHARACTER SET utf8mb4 COLLATE utf8mb4_bin;

Set environment variables:

    DB_USERNAME=kpchat
    DB_PASSWORD=kpchat

Run migrations:

    php artisan migrate

## Laravel echo server

    npm install -g laravel-echo-server
    laravel-echo-server start

## Redis

    redis-server
