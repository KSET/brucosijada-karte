#Starting image
FROM php:8.0-apache

#OS tools
RUN apt-get update && \
    apt-get install -y \
    curl \
    libmcrypt-dev \
    libreadline-dev \
    libzip-dev \
    git

#PHP extras
RUN pecl install mcrypt
RUN apt-get update && apt-get install -y \
        zlib1g-dev \
        libmcrypt-dev \
    && docker-php-ext-install -j$(nproc) zip pdo pdo_mysql \
    && docker-php-ext-enable mcrypt

#Clean update
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

#Composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php \
    && php -r "unlink('composer-setup.php');" \
    && mv composer.phar /usr/bin/composer \
    && chmod +x /usr/bin/composer


#Copy app and run Composer
COPY ./brucosijada-karte /var/www/brucosijada-karte
WORKDIR /var/www/brucosijada-karte
RUN composer install --ignore-platform-reqs
RUN php artisan key:generate
#RUN php artisan migrate --force
#RUN php artisan db:seed --force


#Apache
COPY apache_conf /etc/apache2/sites-available/000-default.conf
RUN a2enmod rewrite ssl && a2enmod rewrite headers
#RUN echo "ServerName brucifer-app.local" >> /etc/apache2/apache2.conf
CMD . /etc/apache2/envvars && exec /usr/sbin/apache2 -DFOREGROUND
RUN apache2ctl start


RUN apt-get install -y gpgv
RUN rm -rf /var/lib/apt/lists/ && curl -sL https://deb.nodesource.com/setup_16.x | bash -
RUN apt-get install nodejs -y
WORKDIR /var/www/brucosijada-karte
RUN npm install && npm run dev