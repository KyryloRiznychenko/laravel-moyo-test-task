FROM php:8.2-fpm-alpine3.20

#ARG USER
#ARG UID

RUN apk update
RUN apk add \
    git \
    curl \
    nano \
    mc \
    libpng-dev \
    oniguruma-dev \
    libxml2-dev \
    zip \
    unzip

RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

#RUN useradd -G www-data,root -u $UID -d /home/$USER $USER
#RUN mkdir -p /home/$USER/.composer && \
#    chown -R $USER:$USER /home/$USER

WORKDIR /var/www

#USER $USER

#EXPOSE 9000
#
#CMD ["php-fpm"]