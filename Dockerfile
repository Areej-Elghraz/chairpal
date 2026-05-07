FROM php:8.2-apache

# System dependencies
RUN apt-get update && apt-get install -y \
    git curl unzip libpq-dev libonig-dev libzip-dev zip \
    && docker-php-ext-install pdo pdo_mysql mbstring zip

# Enable Apache rewrite
RUN a2enmod rewrite

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copy project
COPY . .

# Install dependencies
RUN composer install --no-dev --optimize-autoloader

# Laravel permissions (مهم جدًا)
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Cleanup caches
RUN php artisan config:clear && \
    php artisan route:clear && \
    php artisan view:clear

# Apache start
CMD ["apache2-foreground"]