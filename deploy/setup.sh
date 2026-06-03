#!/bin/bash
set -e

echo "=========================================="
echo " Clyrion Studio - Production Setup"
echo "=========================================="

if [ ! -f .env ]; then
    echo "ERROR: .env file not found. Create it from .env.example"
    exit 1
fi

export $(grep -v '^\s*#' .env | grep -v '^\s*$')

echo "Creating required directories..."
mkdir -p src/storage/app/public
mkdir -p src/storage/framework/cache
mkdir -p src/storage/framework/sessions
mkdir -p src/storage/framework/views
mkdir -p src/storage/logs
mkdir -p src/public/storage

echo "Setting permissions..."
chmod -R 775 src/storage
chmod -R 775 src/bootstrap/cache

echo "Building and starting containers..."
docker compose -f docker-compose.prod.yml build --no-cache
docker compose -f docker-compose.prod.yml up -d

echo "Waiting for PostgreSQL..."
until docker compose -f docker-compose.prod.yml exec -T postgres pg_isready -U clyrion_user; do
    sleep 2
done

echo "Running Laravel setup..."
docker compose -f docker-compose.prod.yml exec -T app php artisan key:generate --force
docker compose -f docker-compose.prod.yml exec -T app php artisan storage:link --force
docker compose -f docker-compose.prod.yml exec -T app php artisan migrate --force
docker compose -f docker-compose.prod.yml exec -T app php artisan config:cache
docker compose -f docker-compose.prod.yml exec -T app php artisan route:cache
docker compose -f docker-compose.prod.yml exec -T app php artisan view:cache
docker compose -f docker-compose.prod.yml exec -T app php artisan event:cache

echo "=========================================="
echo " Setup complete!"
echo "=========================================="
