FROM php:8.4-apache

RUN a2enmod rewrite

# dependencies used for composer
RUN apt-get update && \
    apt-get install -y git && \
	apt-get install -y zip unzip && \
    apt-get install -y wget

# install mysq libs for php
RUN docker-php-ext-install pdo pdo_mysql

# install php composer
ADD install-composer.sh ./install-composer.sh
RUN chmod ugo+x ./install-composer.sh
RUN ./install-composer.sh

# user for jenkins pipeline
RUN addgroup --gid 1000 build && adduser --uid 1000 --gid 1000 --disabled-password --gecos "" build
RUN usermod -a -G build www-data
