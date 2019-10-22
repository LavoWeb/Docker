FROM alpine:3.7
MAINTAINER Aurélien Lavorel <aurelien@lavoweb.net>

ENV VARNISH_PORT 80
RUN apk update && apk add --no-cache varnish
COPY default.vcl /etc/varnish/default.vcl

EXPOSE 80 443 8080
CMD varnishd -f /etc/varnish/default.vcl -s malloc,100M -a 0.0.0.0:${VARNISH_PORT} && varnishlog