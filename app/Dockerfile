FROM php:5.6.40-apache

WORKDIR /app

RUN apt-get update && \
    docker-php-ext-install mysqli pdo pdo_mysql

EXPOSE 9000