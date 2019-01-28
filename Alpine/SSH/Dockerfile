FROM alpine:latest
MAINTAINER Aurélien Lavorel <aurelien@lavoweb.net>

RUN apk update && apk add --no-cache openssh sshpass
RUN echo "StrictHostKeyChecking no" >> /etc/ssh/ssh_config

CMD ["tail", "-f", "/dev/null"]
