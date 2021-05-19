FROM php:7.4-fpm-buster

# Install php librairies
RUN DEBIAN_FRONTEND=noninteractive apt update -q \
    && DEBIAN_FRONTEND=noninteractive apt install -qq -y \
      curl wget \
      sudo \ 
      vim \
      nano \
      net-tools \
      iputils-ping \
      git \
      zip unzip \
      g++ \
      zlib1g-dev \
      libzip-dev \
      libbz2-dev \
      libfreetype6-dev \
      libldb-dev libldap2-dev \
      libmcrypt-dev \
      libpng-dev \
      libpq-dev \
      libjpeg-dev \
      libicu-dev  \
      libonig-dev \
      libxslt1-dev \
      xfonts-75dpi \
      fontconfig \
      libxrender1 \
      xfonts-base \
      postgresql-client \
      poppler-utils \
      ghostscript \
    &&  apt install -y libmagickwand-dev --no-install-recommends \
    && docker-php-ext-configure gd --with-freetype=/usr/include/ --with-jpeg=/usr/include/ \
    && docker-php-ext-install \
      bcmath \
      bz2 \
      calendar \
      exif \
      gd \
      intl \
      ldap \
      mysqli \
      opcache \
      pdo_mysql \
      pdo_pgsql \
      pgsql \
      soap \
      xsl \
      zip \
      sockets \
    && pecl install apcu apcu_bc imagick \
    && docker-php-ext-enable apcu imagick

RUN wget -q https://github.com/wkhtmltopdf/packaging/releases/download/0.12.6-1/wkhtmltox_0.12.6-1.buster_amd64.deb

RUN dpkg -i wkhtmltox_0.12.6-1.buster_amd64.deb

RUN cp -a /usr/local/bin/wkhtmltopdf /usr/bin/

RUN rm -f wkhtmltox_0.12.6-1.buster_amd64.deb
# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer --version=1.8.6 \
    && ln -s $(composer config --global home) /root/composer
ENV PATH=$PATH:/root/composer/vendor/bin COMPOSER_ALLOW_SUPERUSER=1

# Install core module Flex
RUN composer global require "symfony/flex" --prefer-dist --no-progress --no-suggest --classmap-authoritative;

# Add config PHP with
#  - opcache enabled
#  - upload_max_filesize = 100M
#  - post_max_size = 100M
#  - memory_limit= 2048M
COPY php.ini /usr/local/etc/php/conf.d/docker-php-config.ini

# Add config PHP with 0.0.0.0:9000 binding 
COPY www.conf /usr/local/etc/php-fpm.d/www.conf
COPY entrypoint.sh /entrypoint.sh

RUN chmod +x /entrypoint.sh

CMD ["/entrypoint.sh"]

CMD ["php-fpm"]
