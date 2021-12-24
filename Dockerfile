FROM php:7.4.0-fpm-alpine


RUN docker-php-ext-install pdo pdo_mysql

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN apk add --update nodejs npm
#WORKDIR is /var/www/html
COPY . /var/www/html/
RUN npm install