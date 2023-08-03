#!/bin/bash

# Abort on any error (including if wait-for-it fails).
set -e

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

# if the database host and port environment variables are set than run wait-for-it.sh
# if [ -n "$DB_HOST" ] && [ -n "$DB_PORT" ]; then
#     ./wait-for-it.sh "$DB_HOST:$DB_PORT"
#     php artisan migrate --seed
# fi

# Run the main container command
exec "$@"
