FROM php:7.2-apache
RUN apt-get update
RUN apt-get install nano
RUN a2enmod rewrite
RUN docker-php-ext-install pdo pdo_mysql
