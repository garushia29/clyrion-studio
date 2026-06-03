#!/bin/bash
set -e

echo "=========================================="
echo " Clyrion Studio - Deploy"
echo "=========================================="

cd "$(dirname "$0")/.."

export $(grep -v '^\s*#' .env | grep -v '^\s*$')

echo "Pulling latest changes..."
git pull origin master

echo "Rebuilding and restarting containers..."
docker compose -f docker-compose.prod.yml build
docker compose -f docker-compose.prod.yml up -d --force-recreate

echo "Running migrations..."
docker compose -f docker-compose.prod.yml exec -T app php artisan migrate --force

echo "Clearing and recaching..."
docker compose -f docker-compose.prod.yml exec -T app php artisan optimize:clear
docker compose -f docker-compose.prod.yml exec -T app php artisan optimize

echo "=========================================="
echo " Deploy complete!"
echo "=========================================="
