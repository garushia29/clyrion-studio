FROM php:8.3-fpm

RUN apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    unzip \
    libpq-dev \
    libzip-dev \
    npm \
    nodejs

RUN docker-php-ext-install pdo pdo_pgsql zip

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

RUN groupadd -g 1000 www && \
    useradd -u 1000 -g www -s /bin/sh -m www

RUN chown -R www:www /var/www
RUN chmod -R 775 /var/www/storage /var/www/bootstrap/cache