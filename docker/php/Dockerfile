FROM php:8.3-fpm-alpine

RUN sed -i 's|http://dl-cdn.alpinelinux.org|https://mirrors.aliyun.com|g' /etc/apk/repositories

RUN apk update && apk add --no-cache \
    bash \
    git \
    curl \
    zip \
    unzip \
    libpq \
    postgresql-dev \
    && docker-php-ext-install pdo pdo_pgsql

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY . .

COPY docker/php/start.sh /start.sh
RUN chmod +x /start.sh

ENTRYPOINT ["/start.sh"]
