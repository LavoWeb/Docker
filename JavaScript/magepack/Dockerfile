FROM node:14
MAINTAINER Aurélien Lavorel <aurelien@lumao.eu>

ENV WORKDIR /home/workspace
WORKDIR ${WORKDIR}

RUN apt-get update \
     && apt-get install -y wget gnupg ca-certificates \
     && wget -q -O - https://dl-ssl.google.com/linux/linux_signing_key.pub | apt-key add - \
     && sh -c 'echo "deb [arch=amd64] http://dl.google.com/linux/chrome/deb/ stable main" >> /etc/apt/sources.list.d/google.list' \
     && apt-get update \
     && apt-get install -y google-chrome-stable chromium \
     && rm -rf /var/lib/apt/lists/*

RUN npm install -g puppeteer --unsafe-perm=true --allow-root
RUN npm install -g magepack --unsafe-perm=true --allow-root
