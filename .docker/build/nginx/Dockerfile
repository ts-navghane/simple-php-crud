FROM nginx:1.19.6-alpine

COPY nginx.conf /etc/nginx/

RUN apk update \
    && apk upgrade \
    && apk add --no-cache nano

EXPOSE 80 443