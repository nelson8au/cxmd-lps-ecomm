# Stage 1: build & composer install
FROM php:7.4-fpm AS builder

RUN apt-get update && apt-get install -y \
    git zip unzip libzip-dev libpng-dev libonig-dev libicu-dev \
    && docker-php-ext-install pdo_mysql mbstring exif bcmath gd intl zip \
    && docker-php-ext-enable pdo_mysql

# Install composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Copy all source code
COPY . .

# Stage 2: runtime
FROM php:7.4-fpm

RUN apt-get update && apt-get install -y nginx supervisor libzip-dev libpng-dev libonig-dev libicu-dev \
    && docker-php-ext-install pdo_mysql mbstring exif bcmath gd intl zip \
    && rm -rf /var/lib/apt/lists/*

# Copy config files
COPY docker/nginx.conf /etc/nginx/nginx.conf
COPY docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Copy ThinkPHP app
COPY --from=builder /app /var/www/html

WORKDIR /var/www/html

# Set permissions
RUN chown -R www-data:www-data /var/www/html && chmod -R 755 /var/www/html

EXPOSE 80

CMD ["/usr/bin/supervisord", "-n", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
