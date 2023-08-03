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

# Install Composer dependencies
composer install

# Install NPM dependencies
npm install

# Generate the application key
php artisan key:generate

# Generate the JWT secret with
php artisan jwt:secret

# set environment variables
# - APP_URL
if [ -n "$APP_URL" ]; then
    sed -i "s@APP_URL=.*@APP_URL=\"$APP_URL\"@" ./.env
fi
# - DB_HOST
if [ -n "$DB_HOST" ]; then
    sed -i "s@DB_HOST=.*@DB_HOST=\"$DB_HOST\"@" ./.env
fi
# - DB_PORT
if [ -n "$DB_PORT" ]; then
    sed -i "s@DB_PORT=.*@DB_PORT=\"$DB_PORT\"@" ./.env
fi
# - DB_DATABASE
if [ -n "$DB_DATABASE" ]; then
    sed -i "s@DB_DATABASE=.*@DB_DATABASE=\"$DB_DATABASE\"@" ./.env
fi
# - DB_USERNAME
if [ -n "$DB_USERNAME" ]; then
    sed -i "s@DB_USERNAME=.*@DB_USERNAME=\"$DB_USERNAME\"@" ./.env
fi
# - DB_PASSWORD
if [ -n "$DB_PASSWORD" ]; then
    sed -i "s@DB_PASSWORD=.*@DB_PASSWORD=\"$DB_PASSWORD\"@" ./.env
fi

php artisan config:clear
php artisan config:cache

# Wait for the database to be up (using wait-for-it.sh).

# if the database host and port environment variables are set than run wait-for-it.sh
if [ -n "$DB_HOST" ] && [ -n "$DB_PORT" ]; then
    ./wait-for-it.sh "$DB_HOST:$DB_PORT"
    php artisan migrate --seed
fi

exit 0
