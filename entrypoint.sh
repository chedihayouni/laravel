#!/usr/bin/env bash

BASE_DIR=/var/www/

# Following folders must be writables by www-data web user
chown -R www-data. $BASE_DIR
find $BASE_DIR -type d -exec chmod 0755 {} \;
find $BASE_DIR -type f -exec chmod 0644 {} \;
