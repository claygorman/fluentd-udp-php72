FROM php:7.2-cli
RUN apt-get update && apt-get install -y git
RUN docker-php-ext-install sockets
COPY app/ /usr/src/app/
WORKDIR /usr/src/app
ADD https://getcomposer.org/download/1.6.3/composer.phar composer.phar
RUN php composer.phar install
CMD [ "php", "./test-script.php" ]
