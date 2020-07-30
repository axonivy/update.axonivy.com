FROM mysql:5.7.19

ADD 00_init.sql /docker-entrypoint-initdb.d/

ENV MYSQL_ROOT_PASSWORD=1234
ENV MYSQL_DATABASE=update_stats
ENV MYSQL_USER=update
ENV MYSQL_PASSWORD=1234
