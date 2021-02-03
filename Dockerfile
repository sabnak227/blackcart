FROM php:7.4-apache

RUN docker-php-ext-install pdo_mysql
RUN a2enmod rewrite

ADD config/docker/apache.conf /etc/apache2/sites-enabled/000-default.conf
RUN cp /usr/local/etc/php/php.ini-production /usr/local/etc/php/php.ini
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    php -r "if (hash_file('sha384', 'composer-setup.php') === '756890a4488ce9024fc62c56153228907f1545c228516cbf63f885e036d37e9a59d27d63f46af1d4d07ee0f76181c7d3') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;" && \
    php composer-setup.php && \
    php -r "unlink('composer-setup.php');" && \
    mv composer.phar /usr/bin/composer

ADD . /var/www/html
RUN chown www-data:www-data -R /var/www/html
RUN cp /var/www/html/.env.example /var/www/html/.env
WORKDIR /var/www/html
RUN composer install
RUN php artisan key:generate
RUN ln -s /var/www/html/vendor/phpunit/phpunit/phpunit /usr/bin/phpunit

