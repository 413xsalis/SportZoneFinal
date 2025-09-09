FROM php:8.2.12-apache

# Actualiza e instala paquetes necesarios (usando apt-get)
RUN apt-get update && apt-get install -y \
    bash \
    curl \
    git \
    libzip-dev \
    libpq-dev \
    zip \
    unzip \
    && docker-php-ext-install pdo pdo_pgsql zip \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Copia Composer desde imagen oficial
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copia el proyecto
COPY . .

# Instala dependencias PHP
RUN composer install --optimize-autoloader --no-dev

# Da permisos necesarios
RUN chmod -R 777 storage bootstrap/cache

EXPOSE 8000

# Comando para producción
CMD php artisan migrate --force && php artisan serve --host 0.0.0.0 --port 8000
