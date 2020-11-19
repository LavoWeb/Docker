FROM php:7.2-apache
MAINTAINER Aurélien Lavorel <aurelien@lumao.eu>

RUN a2enmod proxy proxy_http
COPY vhost.conf /etc/apache2/sites-enabled/000-default.conf
