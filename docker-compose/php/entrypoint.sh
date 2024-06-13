#!/bin/sh

set -x

cd /var/www

composer install

echo "IS RUNNING LOCAL-DEVELOPMENT MODE"

if [ ! -e "./database/database.sqlite" ]; then
    touch "./database/database.sqlite"
    echo "The database.sqlite file has been created for local development"
fi

cp .env.example .env
php artisan migrate:fresh --seed
php artisan storage:link

php artisan key:generate

php-fpm