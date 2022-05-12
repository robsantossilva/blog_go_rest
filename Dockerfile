FROM php:8.1.0-fpm-alpine

RUN apk add --no-cache shadow

RUN apk add --no-cache openssl \
    bash \
    mysql-client \
    nodejs \
    git \
    npm \
    freetype-dev \
    libjpeg-turbo-dev \
    libpng-dev \
    libzip-dev

RUN touch /home/www-data/.bashrc | echo "PS1='\w\$ '" >> /home/www-data/.bashrc

RUN docker-php-ext-install pdo pdo_mysql bcmath zip

ENV DOCKERIZE_VERSION v0.6.1
RUN wget https://github.com/jwilder/dockerize/releases/download/$DOCKERIZE_VERSION/dockerize-linux-amd64-$DOCKERIZE_VERSION.tar.gz \
    && tar -C /usr/local/bin -xzvf dockerize-linux-amd64-$DOCKERIZE_VERSION.tar.gz \
    && rm dockerize-linux-amd64-$DOCKERIZE_VERSION.tar.gz

WORKDIR /var/www
RUN rm -rf /var/www/html

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN ln -s public html

RUN npm config set cache /var/www/.npm-cache --global

RUN usermod -u 1000 www-data
USER www-data

EXPOSE 9000

ENTRYPOINT ["php-fpm"]