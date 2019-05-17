FROM golang:1.12
MAINTAINER Aurélien Lavorel <aurelien@lavoweb.net>

RUN go get github.com/AurelienLavorel/dockssh
RUN ssh-keygen -t rsa -f /root/.ssh/id_rsa
RUN apt update && apt-get install -y libltdl7

CMD ["tail", "-f", "/dev/null"]