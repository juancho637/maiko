FROM composer:1.10.4

COPY ./ /app

RUN rm -rf .git .config .circleci Dockerfile .DS_Store .gitignore readme.md \
    .env .env.example .editorconfig .env.testing .gitattributes && \
    composer install --optimize-autoloader
    # --no-dev

FROM php:7.3-fpm-alpine3.11

RUN docker-php-ext-install bcmath pdo_mysql

RUN apk --no-cache add nginx supervisor freetype libpng libjpeg-turbo \
    freetype-dev libpng-dev libjpeg-turbo-dev

COPY ./.circleci/config/nginx.conf /etc/nginx/nginx.conf

COPY ./.circleci/config/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

RUN docker-php-ext-configure gd --with-gd --with-freetype-dir=/usr/include/ --with-png-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install gd

RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini" \
    && sed -i "s/memory_limit = 128M/memory_limit = 64M/g" $PHP_INI_DIR/php.ini \
    && sed -i "s/upload_max_filesize = 2M/upload_max_filesize = 64M/g" $PHP_INI_DIR/php.ini \
    && sed -i "s/post_max_size = 8M/post_max_size = 64M/g" $PHP_INI_DIR/php.ini \
    && sed -i "s/max_execution_time = 30/max_execution_time = 600/g" $PHP_INI_DIR/php.ini

COPY --chown=www-data:www-data --from=0 /app /var/www/html

CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]

EXPOSE 8080
