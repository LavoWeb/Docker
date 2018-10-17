FROM lavoweb/php-7.2:opcache
MAINTAINER lavoweb <aurelien@lavoweb.net>

RUN sed -ie s#/var/www/html#/var/www/html/pub#g /etc/apache2/sites-enabled/000-default.conf
RUN sed -ie s#/var/www/html#/var/www/html/pub#g /etc/apache2/sites-enabled/default-ssl.conf
RUN /etc/init.d/cron start
