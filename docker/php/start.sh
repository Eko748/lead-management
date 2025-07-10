#!/bin/sh

if [ ! -d "vendor" ]; then
    echo "Running composer install..."
    composer install --prefer-dist --optimize-autoloader
fi

chown -R www-data:www-data /var/www
chmod -R 775 /var/www/storage /var/www/bootstrap/cache

if ! grep -q '^APP_KEY=' .env || [ -z "$APP_KEY" ]; then
    php artisan key:generate
fi

php artisan migrate --seed --force
php artisan optimize:clear

exec php-fpm
