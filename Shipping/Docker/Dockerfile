FROM trafex/php-nginx:latest

COPY nginx.conf /etc/nginx/nginx.conf
COPY --chown=nobody . /var/www/html

USER root

RUN apk add --no-cache \
  git \
  php81-iconv \
  php81-tokenizer \
  php81-simplexml \
  php81-pdo \
  php81-pdo_mysql\
  php81-pecl-xdebug\
  php81-posix

COPY --from=composer /usr/bin/composer /usr/bin/composer

USER nobody
#RUN composer install --optimize-autoloader --no-interaction --no-progress