FROM lavoweb/php-8.3:opcache
MAINTAINER lavoweb <aurelien@lumao.eu>

RUN sed -ie s#/var/www/html#/var/www/html/pub#g /etc/apache2/sites-enabled/000-default.conf
RUN sed -ie s#/var/www/html#/var/www/html/pub#g /etc/apache2/sites-enabled/default-ssl.conf
