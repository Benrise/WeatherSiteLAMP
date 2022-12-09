FROM php:8.0.19-apache


ARG DEBIAN_FRONTEND=noninteractive

# Синхронизируем и обновляем пакеты
RUN apt-get -y update --fix-missing && \
    apt-get upgrade -y && \
    apt-get --no-install-recommends install -y apt-utils libaprutil1-dbd-mysql && \
    rm -rf /var/lib/apt/lists/*

# Устанавливаем нужные инстурменты и важные библиотеки для работы
RUN apt-get -y update && \
    apt-get -y --no-install-recommends install nano wget \
dialog \
libsqlite3-dev \
libsqlite3-0 && \
    apt-get -y --no-install-recommends install default-mysql-client

# Необходимые расширения PHP8 для работы с модулями SQL
RUN docker-php-ext-install pdo_mysql && \
    docker-php-ext-install pdo_sqlite &&  \
    docker-php-ext-install mysqli

#Нам нужно установить расширения redis, иначе PHP не сможет подключиться к серверу Redis.
RUN apt-get update && apt-get -y install wget redis-tools && \
    pecl -v install redis && docker-php-ext-enable redis && \
    bash -c "echo extension=redis.so > /usr/local/etc/php/conf.d/redis.ini"

#installing gd
RUN apt-get update && \
apt-get install -y libfreetype6-dev libjpeg62-turbo-dev libpng-dev && \
docker-php-ext-configure gd --with-freetype=/usr/include/ --with-jpeg=/usr/include/ && \
docker-php-ext-install gd

EXPOSE 81