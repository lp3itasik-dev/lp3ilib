# Gunakan PHP-FPM sebagai base image
FROM php:8.2-fpm

# Install dependensi yang dibutuhkan Laravel
RUN apt-get update && apt-get install -y \
    git unzip curl libpng-dev libjpeg-dev libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy seluruh isi Laravel ke dalam container
COPY . ./

# Berikan izin ke storage dan bootstrap
RUN chmod -R 775 storage bootstrap/cache

# Jalankan Composer Install
#RUN composer install --no-dev --optimize-autoloader

# Expose port yang akan digunakan Laravel
EXPOSE 8081
