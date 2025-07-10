#!/bin/sh

echo "🔧 Setting folder permissions..."
chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache
chmod -R 775 /var/www/storage /var/www/bootstrap/cache

echo "🧹 Clearing Laravel caches..."
php artisan config:clear
php artisan route:clear
php artisan view:clear

echo "🧩 Running database migrations..."
php artisan migrate --force

echo "🚀 Starting PHP-FPM..."
exec php-fpm
