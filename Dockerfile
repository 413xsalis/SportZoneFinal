From php:8.1-apache

RUN apk add --no-cache \
    bash \
    curl \
    git \
    libzip-dev \
    postgresql-dev \
    zip \

RUN docker-php-ext-install pdo pdo_pgsql zip

COPY --composer install:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

RUN composer install --optimize-autoloader --no-dev

RUN chmod -R 777  storage bootstrap/cache


EXPOSE 8000

CMD php artisan migrate --force && php artisan serve --host 0.0.0.0 --port 8000

