FROM python:2-alpine
MAINTAINER Aurélien Lavorel <aurelien@lavoweb.net>
RUN apk update
RUN apk add git rsync gcc libffi libffi-dev musl-dev linux-headers openssl-dev make sshpass
RUN pip install ansible
RUN ansible-galaxy install carlosbuenosvinos.ansistrano-deploy carlosbuenosvinos.ansistrano-rollback
CMD tail -f /dev/null