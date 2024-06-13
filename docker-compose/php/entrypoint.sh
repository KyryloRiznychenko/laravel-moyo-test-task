#!/bin/sh

set -x

cd /var/www

composer install

if [ "$APP_ENV" = 'production' ]; then
    echo "IS RUNNING PRODUCTION MODE"
    cp .env.example .env
else
    echo "IS RUNNING LOCAL-DEVELOPMENT MODE"

    if [ ! -e "./database/database.sqlite" ]; then
        touch "./database/database.sqlite"
        echo "The database.sqlite file has been created for local development"
    fi

    cp .env.example.local .env
    php artisan migrate:fresh --seed
    php artisan storage:link
fi

php artisan key:generate

php-fpm