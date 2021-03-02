FROM postgres:13.1-alpine

#RUN mkdir -p /var/lib/postgresql-static/data
#ENV PGDATA /var/lib/postgresql-static/data

COPY db.sql /docker-entrypoint-initdb.d/
