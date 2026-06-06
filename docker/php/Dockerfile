FROM php:8.3-fpm

RUN apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    unzip \
    libpq-dev \
    libzip-dev \
    libicu-dev \
    npm \
    nodejs

RUN docker-php-ext-install pdo pdo_pgsql zip intl

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

RUN groupadd -g 1000 www && \
    useradd -u 1000 -g www -s /bin/sh -m www

RUN chown -R www:www /var/www && \
    mkdir -p /var/log/php-fpm && \
    chown www:www /var/log/php-fpm && \
    mkdir -p /var/www/storage/app/public && \
    ln -sf /var/www/storage/app/public /var/www/public/storage || true
COPY docker/php/www.conf /usr/local/etc/php-fpm.d/www.conf
COPY docker/php/php.ini /usr/local/etc/php/conf.d/custom.ini