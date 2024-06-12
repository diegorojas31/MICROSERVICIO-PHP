FROM php:8.2-apache

RUN apt-get update && apt-get install -y \
    libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql

WORKDIR /var/www/MicroservicePHP

COPY . .

RUN chown -R www-data:www-data /var/www/MicroservicePHP/storage /var/www/MicroservicePHP/bootstrap/cache

CMD php artisan serve --host=0.0.0.0 --port=8000




