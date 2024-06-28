FROM php:8.3.8-fpm

# Update package lists and install dependencies
RUN apt-get update -y && apt-get install -y \
    openssl \
    zip \
    unzip \
    git

# Set working directory
WORKDIR /var/www/html

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN apt install -y libpq-dev \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo pdo_pgsql pgsql

# Then copy the rest of the application files
COPY . /var/www/html

# Install Composer dependencies
RUN composer install \
    --ignore-platform-reqs \
    --optimize-autoloader \
    --no-interaction \
    --no-scripts \
    --prefer-dist \
    --quiet

RUN composer dump-autoload --classmap-authoritative

RUN composer clear-cache

COPY autoload_runtime.php /var/www/html/vendor

# Expose port 9000
EXPOSE 9000

# Start the PHP-FPM server
CMD ["php-fpm"]
