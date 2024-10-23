# Use the official PHP 8.2 FPM image with Alpine
FROM php:8.2-fpm-alpine

# Set working directory
WORKDIR /var/www/html

# Install system dependencies including Linux headers and build tools
RUN apk add --no-cache \
    git \
    zip \
    unzip \
    libzip-dev \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    icu-dev \
    bash \
    postgresql-dev \
    rabbitmq-c-dev \
    libmcrypt-dev \
    libxml2-dev \
    oniguruma-dev \
    linux-headers \
    autoconf \
    g++ \
    make \
    supervisor \
    nodejs \
    npm \
    yarn

# Install PHP extensions
RUN docker-php-ext-install \
    pdo_pgsql \
    intl \
    gd \
    zip \
    opcache \
    sockets

# Install Redis extension via PECL
RUN pecl install redis && docker-php-ext-enable redis

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/local/bin/composer

# Copy custom php.ini configuration
COPY ./php.ini /usr/local/etc/php/php.ini

# Set permissions for application directory
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html \
    && mkdir -p /var/log \
    && chown -R www-data:www-data /var/log

# Copy Supervisor configuration
COPY ./supervisor/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Copy entrypoint.sh script into the container
COPY init.sh /usr/local/bin/init.sh
RUN chmod +x /usr/local/bin/init.sh

# Expose port 9000 for PHP-FPM
EXPOSE 9000

ENTRYPOINT ["/usr/local/bin/init.sh"]