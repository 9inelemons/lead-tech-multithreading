FROM php:7.3-zts-alpine

RUN apk add --no-cache \
        git \
    && git clone https://github.com/krakjoe/pthreads -b master /tmp/pthreads \
    && docker-php-ext-configure /tmp/pthreads --enable-pthreads \
    && docker-php-ext-install /tmp/pthreads \
    && apk del \
        git \
    && rm -rf /var/cache/apk/* /tmp/* /var/tmp/*

# Добавим свой php.ini, можем в нем определять свои значения конфига
COPY php.ini /usr/local/etc/php/

# Куда же без composer'а.
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Указываем рабочую директорию для PHP
WORKDIR /var/www

# Запускаем контейнер
# Из документации: The main purpose of a CMD is to provide defaults for an executing container. These defaults can include an executable,
# or they can omit the executable, in which case you must specify an ENTRYPOINT instruction as well.
CMD [ "php", "index.php" ]