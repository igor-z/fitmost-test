FROM yiisoftware/yii2-php:7.2-apache

COPY 000-default.conf /etc/apache2/sites-available/000-default.conf
COPY xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

RUN pecl install xdebug-2.7.0 \
    && docker-php-ext-enable xdebug
