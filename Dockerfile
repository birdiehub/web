FROM php:8.2-fpm

# Arguments defined in docker-compose.yml
ARG user
ARG uid

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    gnupg

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Create system user to run Composer and Artisan Commands
RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user

RUN curl -sL https://deb.nodesource.com/setup_18.x  | bash -
RUN apt-get -y install nodejs

# Set working directory
WORKDIR /var/www

# Remove existing files (for fresh install)
RUN rm -rf vendor
RUN rm -f composer.lock
RUN rm -rf node_modules
RUN rm -f package-lock.json
RUN rm -f .env

# Create new .env file
RUN cp .env.example .env

# Install library dependencies
RUN composer install
RUN npm install

# Generate the application key
RUN php artisan key:generate

# Generate the JWT secret with
RUN php artisan jwt:secret

# Include entrypoint script
ENTRYPOINT ["./entrypoint.sh"]

CMD ["php-fpm"]

USER $user
