#!/bin/bash

# Abort on any error (including if wait-for-it fails).
set -e

# Remove existing files (for fresh install)
rm -rf vendor
rm -f composer.lock
rm -rf node_modules
rm -f package-lock.json
rm -f .env

# Create new .env file
cp .env.example .env

# Install dependencies
composer install
npm install

# Generate the application key
php artisan key:generate

# Generate the JWT secret with
php artisan jwt:secret

# set environment variables
# - APP_URL
if [ -n "$APP_URL" ]; then
    sed -i "s@APP_URL=.*@APP_URL=\"$APP_URL\"@" ./.env
    echo "APP_URL set to $APP_URL"
fi
# - DB_HOST
if [ -n "$DB_HOST" ]; then
    sed -i "s@DB_HOST=.*@DB_HOST=\"$DB_HOST\"@" ./.env
    echo "DB_HOST set to $DB_HOST"
fi
# - DB_PORT
if [ -n "$DB_PORT" ]; then
    sed -i "s@DB_PORT=.*@DB_PORT=\"$DB_PORT\"@" ./.env
    echo "DB_PORT set to $DB_PORT"
fi
# - DB_DATABASE
if [ -n "$DB_DATABASE" ]; then
    sed -i "s@DB_DATABASE=.*@DB_DATABASE=\"$DB_DATABASE\"@" ./.env
    echo "DB_DATABASE set to $DB_DATABASE"
fi
# - DB_USERNAME
if [ -n "$DB_USERNAME" ]; then
    sed -i "s@DB_USERNAME=.*@DB_USERNAME=\"$DB_USERNAME\"@" ./.env
    echo "DB_USERNAME set to $DB_USERNAME"
fi
# - DB_PASSWORD
if [ -n "$DB_PASSWORD" ]; then
    sed -i "s@DB_PASSWORD=.*@DB_PASSWORD=\"$DB_PASSWORD\"@" ./.env
    echo "DB_PASSWORD set"
fi

php artisan config:clear
php artisan config:cache

# Wait for the database to be up (using wait-for-it.sh).
# if the database is up then run the migrations and seed the database
if [ -n "$DB_HOST" ] && [ -n "$DB_PORT" ]; then
    ./wait-for-it.sh "$DB_HOST:$DB_PORT" -s -t 300
    php artisan migrate --seed
fi

# Build Vue app
npm run build

# Run the main container command
# Docker container must have a continues process running (else it will exit)
# No continues command? Use tail -f /dev/null
php-fpm &

wait
