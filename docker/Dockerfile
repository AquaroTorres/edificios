FROM serversideup/php:8.4-fpm-nginx

USER root

RUN install-php-extensions intl mbstring

USER www-data

COPY --chmod=755 docker/entrypoint.d /etc/entrypoint.d

WORKDIR /var/www/html

COPY --chown=www-data:www-data . .

RUN composer install --optimize-autoloader