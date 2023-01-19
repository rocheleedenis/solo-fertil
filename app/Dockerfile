FROM php:5.6.40-apache

WORKDIR /var/www/html

RUN apt-get update && \
    docker-php-ext-install mysqli pdo pdo_mysql

EXPOSE 9000