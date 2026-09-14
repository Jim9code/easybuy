#!/bin/bash
set -e

echo "Starting EasyBuy Application on Render..."

# If APP_KEY is missing, auto-generate one to prevent MissingAppKeyException
if [ -z "$APP_KEY" ]; then
    echo "APP_KEY not found in environment. Generating a runtime application key..."
    export APP_KEY=$(php artisan key:generate --show --no-ansi)
    echo "Runtime APP_KEY generated successfully."
fi

# Ensure storage link exists
php artisan storage:link || true

# Clear stale caches before re-caching with live environment variables
php artisan config:clear || true
php artisan cache:clear || true
php artisan route:clear || true
php artisan view:clear || true

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
