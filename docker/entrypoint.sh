#!/bin/bash
set -e

echo "Starting EasyBuy Application on Render..."

# Create storage link if not exists
php artisan storage:link || true

# Optimize configuration and caches for production
php artisan config:cache || true
php artisan route:cache || true
php artisan view:cache || true

# Run database migrations if database connection is available
if [ -n "$DB_HOST" ] || [ -n "$DATABASE_URL" ]; then
    echo "Running database migrations..."
    php artisan migrate --force || echo "Migration skipped or database not yet reachable."

    if [ "$RUN_SEEDERS" = "true" ]; then
        echo "Running database seeders..."
        php artisan db:seed --force || echo "Seeding completed or already present."
    fi
fi

echo "EasyBuy initialization complete. Starting services..."

# Execute the main container command (supervisord)
exec "$@"
