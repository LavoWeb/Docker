FROM python:3-alpine
MAINTAINER Aurélien Lavorel <aurelien@lavoweb.net>

RUN apk update && apk add --no-cache zip curl linux-headers openssl-dev
RUN pip install -U pip
RUN pip install awscli

CMD ["tail", "-f", "/dev/null"]