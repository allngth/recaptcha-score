FROM php:8.1.14-fpm-alpine3.16

COPY . /app

WORKDIR /app

CMD ["php", "-S", "0.0.0.0:8000"]