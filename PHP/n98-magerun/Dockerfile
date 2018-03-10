FROM lavoweb/php-7.0
MAINTAINER Aurélien Lavorel <aurelien@lavoweb.net>

RUN apt install --yes --force-yes git
RUN curl -O http://files.magerun.net/n98-magerun.phar && chmod +x ./n98-magerun.phar && mkdir -p ~/.n98-magerun/modules/ && cp ./n98-magerun.phar /usr/local/bin/n98-magerun
RUN git clone https://github.com/AOEpeople/mpmd.git ~/.n98-magerun/modules/mpmd
RUN git clone https://github.com/peterjaap/magerun-addons.git ~/.n98-magerun/modules/pj-addons

CMD ["tail", "-f", "/dev/null"]
