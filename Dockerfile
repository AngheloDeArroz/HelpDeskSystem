# --- Stage 1: Composer (Dependencies) ---
FROM php:8.4-fpm-alpine AS composer-stage
WORKDIR /app
RUN apk add --no-cache git unzip libzip-dev libpng-dev libxml2-dev
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
COPY composer.json composer.lock ./
# We keep dev dependencies for local dev so Pail is found
RUN composer install --no-interaction --optimize-autoloader --no-scripts

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

# Install system dependencies
RUN apk add --no-cache \
    nginx \
    supervisor \
    postgresql-dev \
    nodejs \
    npm \
    libpng-dev \
    libxml2-dev \
    libzip-dev \
    zip \
    unzip \
    icu-dev

# Install PHP extensions
RUN docker-php-ext-install pdo_pgsql pgsql gd zip bcmath intl opcache

# --- PERMISSIONS FIX ---
# Create directories as ROOT
RUN mkdir -p /var/log/supervisor /var/run/nginx /var/lib/nginx/tmp /var/log/nginx

# Copy files
COPY --from=composer-stage /app/vendor ./vendor
COPY . .
COPY --from=vite-stage /app/public/build ./public/build

# Setup configs
COPY docker/nginx/default.conf /etc/nginx/http.d/default.conf
COPY docker/supervisor/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Setup entrypoint
COPY docker/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

# IMPORTANT: We do NOT use "USER www-data" at the end.
# We stay as ROOT so Supervisor can start. 
# We fix permissions inside the entrypoint or via the volume mount.
USER root

EXPOSE 80

ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]