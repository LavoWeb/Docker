FROM lavoweb/php-7.2
MAINTAINER Aurélien Lavorel <aurelien@lavoweb.net>

# Magento Cloud
RUN curl -sS https://accounts.magento.cloud/cli/installer | php \
    && cp -R $HOME/.magento-cloud/bin/* /usr/local/bin/