FROM php:8.0-fpm-alpine

#сделать композер доступным внутри контейнера
COPY ./php-fpm/conf.d /usr/local/etc/php/conf.d
COPY --from=composer /usr/bin/composer /usr/bin/composer

RUN apk update \
    && apk --no-cache upgrade \
    && apk add yaml-dev autoconf make g++ \
    && pecl install yaml-2.2.2 \
    && pecl install xdebug-3.1.2 \
    && docker-php-ext-install mysqli pdo pdo_mysql \
    && docker-php-ext-install bcmath \
    && docker-php-ext-enable yaml \
    && docker-php-ext-enable xdebug

RUN mv $PHP_INI_DIR/php.ini-development $PHP_INI_DIR/php.ini

COPY ./php-fpm/entrypoint.sh /usr/local/bin/docker-php-entrypoint
RUN chmod +x /usr/local/bin/docker-php-entrypoint

WORKDIR ./app




