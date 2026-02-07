#!/bin/sh

# Ensure storage and bootstrap/cache are writable
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache

# Generate key if not set
if [ -z "$APP_KEY" ]; then
    php artisan key:generate --no-interaction
fi

# Run migrations
php artisan migrate --force

# Start Supervisor
/usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf
