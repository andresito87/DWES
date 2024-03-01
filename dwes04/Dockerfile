FROM php:8.2.6-apache-buster

# Instala dependencias necesarias
RUN apt-get update && apt-get install -y
RUN apt-get install -y git zip unzip

# Descarga e instala Composer
RUN curl -sS https://getcomposer.org/installer | php
RUN mv composer.phar /usr/local/bin/composer

# Copia el contenido de la aplicación en el contenedor
VOLUME /var/www/html
WORKDIR /var/www/html
COPY . /var/www/html/

# Establece la variable de entorno COMPOSER_ALLOW_SUPERUSER
ENV COMPOSER_ALLOW_SUPERUSER 1

EXPOSE 80

RUN docker-php-ext-install pdo pdo_mysql && docker-php-ext-enable pdo pdo_mysql
