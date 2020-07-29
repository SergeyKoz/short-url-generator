FROM php:fpm-alpine

# Copy composer.lock and composer.json
# COPY composer.lock composer.json /var/www/

# Set working directory
WORKDIR /var/www

# Install dependencies
RUN apk -v --update add \
    zip \
    mc \
    unzip \
    git \
    curl

# Clear cache
RUN rm -rf /var/lib/apt/lists/*


# Install extensions
RUN apk add mysql-client zlib-dev libzip-dev libpng-dev libjpeg-turbo-dev freetype-dev \
    && docker-php-ext-install mysqli pdo pdo_mysql zip \
    && docker-php-ext-enable mysqli \
    && docker-php-ext-configure mysqli --with-mysql-sock=/var/run/mysqld/mysqld.sock \
    && docker-php-ext-configure gd --with-freetype=/usr/include/ --with-jpeg=/usr/include/ \
    && docker-php-ext-install gd

#RUN apk add mysql-client libmcrypt-dev libmemcached-dev zlib-dev \
#    && pecl install xdebug mcrypt-1.0.3 \
#    && pecl install memcached \
#    && docker-php-ext-install mysqli pdo pdo_mysql \
#    && docker-php-ext-enable mysqli \
#    && docker-php-ext-configure mysqli --with-mysql-sock=/var/run/mysqld/mysqld.sock \
#    && docker-php-ext-enable xdebug \
#    && docker-php-ext-enable mcrypt \
#    && docker-php-ext-enable memcached


# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- \
        --filename=composer \
        --install-dir=/usr/local/bin && \
        echo "alias composer='composer'" >> /root/.bashrc && \
        composer

# Add user for laravel application
#RUN groupadd -g 1000 www && useradd -u 1000 -ms /bin/bash -g www www

RUN addgroup -S www && adduser -S www -G www

# RUN addgroup -S appgroup && adduser -S appuser -G appgroup

# Copy existing application directory contents
#COPY . /var/www

# Copy existing application directory permissions
# COPY --chown=www:www . /var/www

# Change current user to www
USER www

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]
