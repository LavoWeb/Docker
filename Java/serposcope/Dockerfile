FROM openjdk:8-jre
ENV DOCKER_SERPOSCOPE_VERSION 2.10.0
RUN mkdir /etc/serposcope/
ADD serposcope.conf /etc/serposcope/serposcope.conf
RUN curl -o /etc/serposcope/serposcope.jar https://serposcope.serphacker.com/download/$DOCKER_SERPOSCOPE_VERSION/serposcope-$DOCKER_SERPOSCOPE_VERSION.jar
CMD java -Dserposcope.conf=/etc/serposcope/serposcope.conf -jar /etc/serposcope/serposcope.jar
