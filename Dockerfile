FROM php:8.2-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libzip-dev

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Create system user to run Composer and Artisan Commands
RUN useradd -G www-data,root -u 1000 -d /home/laravel laravel
RUN mkdir -p /home/laravel/.composer && \
    chown -R laravel:laravel /home/laravel

# Create Laravel project in temp directory and move to /var/www
RUN composer create-project --prefer-dist laravel/laravel /tmp/laravel && \
    rm -rf /var/www/* /var/www/.* 2>/dev/null || true && \
    mv /tmp/laravel/* /var/www/ && \
    mv /tmp/laravel/.* /var/www/ 2>/dev/null || true && \
    rm -rf /tmp/laravel && \
    chown -R laravel:laravel /var/www

# Set working directory
WORKDIR /var/www

# Change current user to laravel
USER laravel

RUN composer install --optimize-autoloader --no-dev

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]