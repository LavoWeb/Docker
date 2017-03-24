FROM python:2-alpine
RUN apk update
RUN apk add git
RUN git clone https://github.com/hartwork/jawanndenn /data
RUN cd /data \
	&& python setup.py install --user
CMD python /data/jawanndenn/main.py --debug --host 0.0.0.0
