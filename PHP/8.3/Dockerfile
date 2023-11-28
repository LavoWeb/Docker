FROM php:8.3-apache
MAINTAINER Aurélien Lavorel <aurelien@lumao.eu>

RUN apt-get update
RUN apt-get install --yes --force-yes cron g++ gettext libicu-dev openssl libc-client-dev libkrb5-dev  libxml2-dev libfreetype6-dev libgd-dev libmcrypt-dev bzip2 libbz2-dev libtidy-dev libcurl4-openssl-dev libz-dev libmemcached-dev libxslt-dev libzip-dev libmagickwand-dev libmagickcore-dev

# PHP Configuration
RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-configure imap --with-kerberos --with-imap-ssl
RUN docker-php-ext-configure hash --with-mhash
RUN docker-php-ext-install -j "$(nproc)" bcmath bz2 calendar dba exif fileinfo gd gettext imap intl pdo pdo_mysql soap tidy xsl zip sockets

# Apache Configuration
RUN a2enmod rewrite
RUN a2enmod headers

# SSL
RUN a2enmod ssl
RUN a2ensite default-ssl
RUN openssl req -subj '/CN=example.com/O=My Company Name LTD./C=US' -new -newkey rsa:2048 -days 365 -nodes -x509 -keyout /etc/ssl/private/ssl-cert-snakeoil.key -out /etc/ssl/certs/ssl-cert-snakeoil.pem
