---
title: "My Docker Setup for Craft CMS"
date: 2019-10-22T17:14:39-04:00
draft: false
---

I get asked this question often, so I figured I would document how I setup my Craft installations that are powered by Docker. There are three main components to my setup; a Dockerfile, Makefile, and docker-compose.yml.

## Dockerfile

The Dockerfile is the main "workhorse" for my flow, it should represent the entirely of the application and should be near identical to production as possible. Some people opt for a `Dockerfile.dev` and `Dockerfile.production` but I personally find this as a cumbersome workflow; especially when your team grows someone will forget to update one and push a deployment.

I always keep my Dockerfile in "production" mode. This means I don't install xdebug or other local development tools, for those requirements I tend to place those commands in the Makefile (e.g. `make xdebug` which will execute the installation steps inside the local docker container). This flow also allows the CI/CD tools to install xdebug in the staging or test process when needed.

{{< highlight docker>}}
# composer
FROM composer as vendor
COPY composer.json composer.json
COPY composer.lock composer.lock
RUN composer install --ignore-platform-reqs --no-interaction --no-scripts --prefer-dist

# node
# FROM node:8-alpine as frontend
# RUN mkdir -p /app/web
# COPY package.json package-lock.json tailwind-config.js /app/
# COPY resources /app/resources
# WORKDIR /app
# RUN npm install && npm production

# apache
FROM php:7.3-apache-stretch
RUN apt-get update && apt-get install -y zlib1g-dev libpng-dev libpq-dev libzip-dev libicu-dev
RUN docker-php-source extract && docker-php-ext-install pdo pdo_mysql pdo_pgsql intl zip bcmath gd && docker-php-source delete
RUN sed -ri -e 's!/var/www/!/var/www/html/web!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf && \
    sed -ri -e 's!/var/www/html!/var/www/html/web!g' /etc/apache2/sites-available/*.conf && a2enmod rewrite
RUN if [ "$APP_ENV" == "production" ]; then mv $PHP_INI_DIR/php.ini-production $PHP_INI_DIR/php.ini; else mv $PHP_INI_DIR/php.ini-development $PHP_INI_DIR/php.ini; fi
RUN sed -i 's/upload_max_filesize = 2M/upload_max_filesize = 10M/g' $PHP_INI_DIR/php.ini
RUN sed -i 's/memory_limit = 128M/memory_limit = 256M/g' $PHP_INI_DIR/php.ini
RUN sed -i 's/max_execution_time = 30/max_execution_time = 120/g' $PHP_INI_DIR/php.ini
COPY .docker/000-default.conf /etc/apache2/sites-enabled
COPY . /var/www/html
COPY --from=vendor /app/vendor/ /var/www/html/vendor/
# COPY --from=frontend /app/web/js/ /var/www/html/web/js/
# COPY --from=frontend /app/web/css/ /var/www/html/web/css/
# COPY --from=frontend /app/mix-manifest.json /var/www/html/mix-manifest.json
RUN chmod -R 777 /var/www/html/storage
{{< /highlight >}}
