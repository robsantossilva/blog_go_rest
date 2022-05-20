#!/bin/bash

cd project
if [ ! -f ".env" ]; then
    cp .env.example .env
fi

chown -R www-data:www-data .
composer install
php artisan key:generate

php-fpm