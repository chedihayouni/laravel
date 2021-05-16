#!/bin/sh
set -e

# first arg is `-f` or `--some-option`
if [ "${1#-}" != "$1" ]; then
    set -- apache2-foreground "$@"
fi

if [ "$1" = 'apache2-foreground' ] && [ ! -d ./vendor ]; then
    mkdir -p var/cache var/log
    chown -R www-data:www-data var

    composer install --no-interaction --no-scripts --prefer-dist
    cp .docker/.env .
    php bin/console cache:clear --env=dev
    php bin/console assets:install
fi

exec "$@"
