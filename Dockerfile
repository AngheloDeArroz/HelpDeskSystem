# --- Stage 1: Composer (Dependencies) ---
FROM php:8.4-fpm-alpine AS composer-stage
WORKDIR /app
RUN apk add --no-cache git unzip libzip-dev libpng-dev libxml2-dev
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
COPY composer.json composer.lock ./
# Note: In local dev, you might want to remove --no-dev if you need Pail
RUN composer install --no-interaction --optimize-autoloader --no-dev --no-scripts

# --- Stage 2: Vite (Assets) ---
FROM node:22-alpine AS vite-stage
WORKDIR /app
COPY package*.json ./
RUN npm install
COPY . .
RUN npm run build

# --- Stage 3: Production (Final Image) ---
FROM php:8.4-fpm-alpine

WORKDIR /var/www

# Install production system dependencies
RUN apk add --no-cache \
    nginx \
    supervisor \
    postgresql-dev \
    libpng-dev \
    libxml2-dev \
    libzip-dev \
    zip \
    unzip \
    icu-dev # Required for 'intl' extension

# Install PHP extensions
RUN docker-php-ext-install pdo_pgsql pgsql gd zip bcmath intl opcache

# --- CRITICAL FIXES START HERE ---
# 1. Create necessary directories for Supervisor, Nginx, and PHP
RUN mkdir -p /var/log/supervisor /var/run/nginx /var/lib/nginx/tmp /var/log/nginx && \
    chown -R www-data:www-data /var/log/supervisor /var/run/nginx /var/lib/nginx /var/log/nginx

# 2. Copy application code
COPY --from=composer-stage /app/vendor ./vendor
COPY . .
COPY --from=vite-stage /app/public/build ./public/build

# 3. Setup configs
COPY docker/nginx/default.conf /etc/nginx/http.d/default.conf
COPY docker/supervisor/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# 4. Fix Permissions for Laravel and Entrypoint
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Ensure entrypoint is copied and executable
COPY docker/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

# --- CRITICAL FIXES END HERE ---

USER www-data
EXPOSE 80

ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]