# -------------------------
# Stage 1: Builder
# -------------------------
FROM php:7.4-fpm AS builder

# Install system dependencies & PHP extensions
RUN apt-get update && apt-get install -y \
    git zip unzip libzip-dev libpng-dev libonig-dev libicu-dev \
    && docker-php-ext-install pdo_mysql mbstring exif bcmath gd intl zip \
    && docker-php-ext-enable pdo_mysql

# Install composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /app

# Copy entire project so 'think' exists for post-autoload scripts
COPY . .

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Run ThinkPHP post-install scripts
RUN php think service:discover && php think vendor:publish

# -------------------------
# Stage 2: Runtime
# -------------------------
FROM php:7.4-fpm

# Install Nginx, Supervisor, and required packages
RUN apt-get update && apt-get install -y \
    nginx supervisor libzip-dev libpng-dev libonig-dev libicu-dev \
    && docker-php-ext-install pdo_mysql mbstring exif bcmath gd intl zip \
    && rm -rf /var/lib/apt/lists/*

# Copy ThinkPHP app from builder
COPY --from=builder /app /var/www/html

# Copy config files
COPY docker/nginx.conf /etc/nginx/nginx.conf
COPY docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Set working directory
WORKDIR /var/www/html

# Set proper permissions
RUN chown -R www-data:www-data /var/www/html && chmod -R 755 /var/www/html

# Expose HTTP port
EXPOSE 80

# Start Supervisord (manages PHP-FPM + Nginx)
CMD ["/usr/bin/supervisord", "-n", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
