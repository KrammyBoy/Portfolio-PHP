FROM php:8.2-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git curl zip unzip libpq-dev nginx \
    && docker-php-ext-install pdo pdo_pgsql

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www

# Copy app
COPY ./src /var/www

# Copy nginx config
COPY ./nginx/nginx.conf /etc/nginx/conf.d/default.conf

# Expose the Railway port
EXPOSE 8080

# Start PHP-FPM + Nginx
CMD service php8.2-fpm start && nginx -g "daemon off;"
