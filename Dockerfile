FROM php:7.1-apache-stretch
# NOTE: We cannot upgrade to 7.2+ until we remove all uses of mcrypt. It is officially removed.

#Instalando o java
RUN mkdir -p /usr/share/man/man1

RUN apt-get update && apt install -y openjdk-8-jdk

RUN apt-get update && apt-get install -y libpq-dev
RUN docker-php-ext-install pdo pdo_pgsql pgsql
RUN ln -s /usr/local/etc/php/php.ini-production /usr/local/etc/php/php.ini
RUN sed -i -e 's/;extension=pgsql/extension=pgsql/' /usr/local/etc/php/php.ini
RUN sed -i -e 's/;extension=pdo_pgsql/extension=pdo_pgsql/' /usr/local/etc/php/php.ini

#Liberando as permissões para escrita dentro do container
RUN chmod -R 777 /var/www/html
RUN usermod -u 1000 www-data;

#Dependencia zip para o composer
RUN apt-get update && apt-get install -y \
    zlib1g-dev \
    libzip-dev \
    unzip
RUN docker-php-ext-install zip

#Instalando o composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
