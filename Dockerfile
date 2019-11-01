FROM php:7.2-apache

ENV COMPOSER_ALLOW_SUPERUSER 1
ENV INSTALL_DEPS="git zlib1g-dev libicu-dev g++"

RUN apt-get update \
    && apt-get install -y $INSTALL_DEPS \
    && docker-php-ext-install zip \
    && docker-php-ext-configure intl \
    && docker-php-ext-install intl \
    && docker-php-ext-install pdo pdo_mysql \
    && a2enmod rewrite \
    && sed -i 's!/var/www/html!/var/www/public!g' /etc/apache2/sites-available/000-default.conf \
    && mv /var/www/html /var/www/public \
    && curl -sS https://getcomposer.org/installer \
      | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www