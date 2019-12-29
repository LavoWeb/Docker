FROM lavoweb/php-5.6
MAINTAINER lavoweb <aurelien@lavoweb.net>

RUN docker-php-ext-enable opcache
RUN echo '\nopcache.enable_cli=1 \n\
opcache.memory_consumption=512 \n\
opcache.max_accelerated_files=100000 \n\
opcache.validate_timestamps=0 \n\
opcache.consistency_checks=0'>> /usr/local/etc/php/conf.d/docker-php-ext-opcache.ini
