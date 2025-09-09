FROM php:8.2.12-apache

# Instala dependencias del sistema
RUN apk add --no-cache \
    bash \
    curl \
    git \
    libzip-dev \
    postgresql-dev \
    zip

# Instala extensiones de PHP
RUN docker-php-ext-install pdo pdo_pgsql zip

# Copia Composer desde una imagen oficial
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copia el código del proyecto
COPY . .

# Instala dependencias de PHP
RUN composer install --optimize-autoloader --no-dev

# Cambia permisos
RUN chmod -R 777 storage bootstrap/cache

EXPOSE 8000

# Comando de inicio
CMD php artisan migrate --force && php artisan serve --host 0.0.0.0 --port 8000
