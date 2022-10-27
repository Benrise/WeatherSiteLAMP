FROM php:8.0.19-apache-buster


ARG DEBIAN_FRONTEND=noninteractive

# Синхронизируем и обновляем пакеты
RUN apt-get -y update --fix-missing && \
    apt-get upgrade -y && \
    apt-get --no-install-recommends install -y apt-utils && \
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
