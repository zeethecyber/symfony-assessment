FROM php:8.3.8-fpm

# Update package lists and install dependencies
RUN apt-get update -y && apt-get install -y \
    openssl \
    zip \
    unzip \
    git

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN apt install -y libpq-dev \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo pdo_pgsql pgsql

# Set working directory
WORKDIR /var/www/html

# Then copy the rest of the application files
COPY . /var/www/html

# Install Composer dependencies
RUN composer install \
    --ignore-platform-reqs \
    --no-interaction \
    --no-dev \
    --no-scripts \
    --prefer-dist

RUN composer dump-autoload --classmap-authoritative

# Expose port 9000
EXPOSE 9000

# Start the PHP-FPM server
CMD ["php-fpm"]
