FROM mysql/mysql-server:8.0

ENV MYSQL_DATABASE=laravel \
  MYSQL_USER=nbeuser \
  MYSQL_PASSWORD=nbepass \
  MYSQL_ROOT_PASSWORD=secret \
  TZ=Asia/Tokyo

COPY ./my.cnf /etc/my.cnf
RUN chmod 644 /etc/my.cnf
