# Base image
FROM php:8.2-fpm

# Set working directory
WORKDIR /var/www

# Install dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    curl \
    nano \
    libzip-dev \
    nodejs \
    npm

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy application code
COPY . .

# Laravel permissions fix
RUN chmod -R 775 storage bootstrap/cache \
 && chown -R www-data:www-data .

# Tạo bootstrap/cache nếu chưa có
RUN mkdir -p bootstrap/cache && \
    chmod -R 775 storage bootstrap/cache && \
    chown -R www-data:www-data .


# Install Composer dependencies
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Generate app key
RUN php artisan key:generate

# Expose port
EXPOSE 8000

# Start Laravel server
CMD php artisan serve --host=0.0.0.0 --port=8000
