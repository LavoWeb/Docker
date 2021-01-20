FROM lavoweb/php-7.0
MAINTAINER Aurélien Lavorel <aurelien@lumao.eu>

RUN apt install git
RUN curl -O http://files.magerun.net/n98-magerun.phar && chmod +x ./n98-magerun.phar && mkdir -p ~/.n98-magerun/modules/ && cp ./n98-magerun.phar /usr/local/bin/n98-magerun
RUN git clone https://github.com/AOEpeople/mpmd.git ~/.n98-magerun/modules/mpmd

CMD ["tail", "-f", "/dev/null"]
