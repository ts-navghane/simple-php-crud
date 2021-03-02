FROM php:7.4-fpm-alpine

# Upgrade and update APK:
RUN apk upgrade && apk update

# Install GIT:
RUN apk add --no-cache git

# Install Composer dependencies:
RUN apk add --no-cache --virtual .composer-deps \
    openssl \
    zip \
    unzip \
    curl \
    wget \
    autoconf \
    g++ \
    make

# Install Composer:
RUN curl -sS https://getcomposer.org/installer | php \
    && mv composer.phar /usr/local/bin/composer

# Install Postgres dependencies:
RUN apk add --no-cache --virtual .pgsql-deps \
    postgresql-dev
RUN docker-php-ext-install pdo pdo_pgsql \
    && apk del postgresql-dev \
    && apk add --upgrade postgresql --update-cache --repository http://dl-3.alpinelinux.org/alpine/edge/main/

# Install Xdebug dependencies:
RUN set -ex \
    && pecl install xdebug-3.0.1 \
    && docker-php-ext-enable xdebug
COPY xdebug.ini /usr/local/etc/php/conf.d/xdebug

# Install Socket dependencies
RUN docker-php-ext-install sockets \
	&& docker-php-ext-configure sockets \
	&& docker-php-ext-enable sockets

# Cleanup:
RUN apk del --purge autoconf g++ make \
    && rm -rf /var/cache/apk/* \
    && rm -rf /var/lib/apt/lists/* \
    && apk del .composer-deps .pgsql-deps

WORKDIR /var/www/html
