# Sử dụng image PHP chính thức có sẵn Apache
FROM php:8.2-apache

# Cài các extension cần thiết cho Laravel
RUN apt-get update && apt-get install -y \
    git zip unzip libpng-dev libonig-dev libxml2-dev curl \
    libzip-dev libpq-dev libjpeg-dev libfreetype6-dev \
    && docker-php-ext-install pdo pdo_mysql zip mbstring exif pcntl bcmath

# Cài Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Tạo thư mục làm việc
WORKDIR /var/www

# Copy toàn bộ mã nguồn vào container
COPY . .

# Tạo thư mục cache nếu chưa có
RUN mkdir -p bootstrap/cache

# Cài các thư viện PHP
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Copy .env.example thành .env nếu chưa có
RUN cp .env.example .env

# Generate key sau khi đã có .env và vendor
RUN php artisan key:generate

# Fix quyền cho storage và bootstrap/cache
RUN chmod -R 775 storage bootstrap/cache && \
    chown -R www-data:www-data .

# Expose cổng mặc định
EXPOSE 8000

# Lệnh chạy chính (Laravel serve)
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
