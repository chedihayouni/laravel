FROM php:7.2-apache

WORKDIR /var/www/laravel_app

COPY . .

COPY ./.docker/apache.conf /etc/apache2/sites-available/000-default.conf

RUN apt-get update && apt-get install -y zlib1g-dev libpng-dev unzip \
    && docker-php-ext-install -j$(nproc) zip \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install -j$(nproc) pdo \
    && docker-php-ext-install -j$(nproc) pdo_mysql

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer --version=1.8.6

RUN a2enmod rewrite

ENV COMPOSER_ALLOW_SUPERUSER=1
ENV APP_ENV=production

COPY ./.docker/docker-entrypoint.sh /usr/local/bin/docker-entrypoint
RUN chmod +x /usr/local/bin/docker-entrypoint

ENTRYPOINT ["docker-entrypoint"]
CMD ["apache2-foreground"]
