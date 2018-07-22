FROM lavoweb/php-7.0
MAINTAINER lavoweb <aurelien@lavoweb.net>

RUN sed -ie s#/var/www/html#/var/www/html/pub#g /etc/apache2/sites-enabled/000-default.conf
RUN sed -ie s#/var/www/html#/var/www/html/pub#g /etc/apache2/sites-enabled/default-ssl.conf
RUN docker-php-ext-enable opcache
RUN echo '\nopcache.enable_cli=1 \n\
opcache.memory_consumption=512 \n\
opcache.max_accelerated_files=100000 \n\
opcache.validate_timestamps=0 \n\
opcache.consistency_checks=0'>> /usr/local/etc/php/conf.d/docker-php-ext-opcache.ini
RUN /etc/init.d/cron start
