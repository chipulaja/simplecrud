FROM php:7.2-apache

ENV APACHE_DOCUMENT_ROOT /var/www/public

RUN mkdir -p ${APACHE_DOCUMENT_ROOT}
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

RUN apt-get update -q -y \
    && apt-get install -q -y --no-install-recommends \
        git \
        zlib1g-dev
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN rm -r -f /var/www/html
RUN chown :www-data /var/www -R

Run docker-php-source extract \
&& docker-php-ext-install exif zip pdo_mysql

RUN a2enmod rewrite


WORKDIR /var/www


CMD ["/usr/sbin/apache2ctl", "-D", "FOREGROUND"]
