FROM php:8.0-fpm

RUN docker-php-ext-install pdo pdo_mysql

RUN apt-get update && apt-get install -y curl git unzip && rm -rf /var/lib/apt/lists/*

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN composer --version