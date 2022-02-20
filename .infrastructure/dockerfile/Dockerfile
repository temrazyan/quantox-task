FROM php:7.3-apache

ENV APACHE_DOCUMENT_ROOT /var/www/html/public

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf

RUN apt update && apt install -y curl libcurl4 libxml2-dev

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin/ --filename=composer
RUN docker-php-ext-install pdo pdo_mysql xml json
RUN a2enmod rewrite

WORKDIR /var/www/html