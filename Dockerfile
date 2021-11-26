FROM php:7.2-apache 
RUN apt-get update -y
RUN docker-php-ext-install mysqli pdo_mysql
RUN a2enmod rewrite