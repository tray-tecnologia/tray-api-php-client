FROM registry.git.tray.net.br/docker/containers/php8.0:0.1

RUN echo "memory_limit = -1" > /usr/local/etc/php/php.ini
RUN apk add git
RUN mkdir -p /var/www/html

COPY . /var/www/html
WORKDIR /var/www/html

RUN composer install  --prefer-dist --no-interaction --no-progress --no-suggest
