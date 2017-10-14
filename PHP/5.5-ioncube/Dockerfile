FROM lavoweb/php-5.5
MAINTAINER Aurélien Lavorel <aurelien@lavoweb.net>

# IonCube
RUN cd /tmp \
    && curl -o ioncube.tar.gz http://downloads3.ioncube.com/loader_downloads/ioncube_loaders_lin_x86-64.tar.gz \
    && tar -xvvzf ioncube.tar.gz \
    && mv ioncube/ioncube_loader_lin_5.5.so /usr/local/lib/php/extensions/* \
    && rm -Rf ioncube.tar.gz ioncube \
    && echo "zend_extension=ioncube_loader_lin_5.5.so" > /usr/local/etc/php/conf.d/00_docker-php-ext-ioncube_loader_lin_5.5.ini