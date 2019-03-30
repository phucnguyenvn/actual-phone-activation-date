FROM php:7.1
MAINTAINER Phuc Nguyen <hong.phuc@outlook.com>

ENTRYPOINT []
WORKDIR /var/www/html/
COPY . /var/www/html/
RUN ls -la /var/www/html/

# Composer
RUN apt-get update && apt-get install -y --no-install-recommends libssl-dev git
RUN curl -fsSL https://getcomposer.org/installer | php && mv composer.phar /usr/local/bin/composer

RUN composer install --no-interaction --prefer-source

ENV PATH /var/www/html:$PATH
CMD ["vendor/bin/phpunit"]