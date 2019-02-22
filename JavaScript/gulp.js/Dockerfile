FROM node:10
MAINTAINER Aurélien Lavorel <aurelien@lavoweb.net>

ENV WORKDIR /home/workspace

WORKDIR ${WORKDIR}

RUN apt-get -yqq update && \
    apt-get install -yqq --no-install-recommends git bzip2 curl unzip && \
    npm install --no-optional --cache /tmp/empty-cache -g gulp && \
    npm cache clean && \
    apt-get -yqq autoremove && \
    apt-get -yqq clean && \
    rm -rf /var/lib/apt/lists/* /var/cache/* /tmp/* /var/tmp/*

RUN echo '{ "allow_root": true }' > /root/.bowerrc
