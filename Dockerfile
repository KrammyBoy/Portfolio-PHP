FROM php:8.2-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    nginx \
    unzip \
    git \
    curl \
    && rm -rf /var/lib/apt/lists/*

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set working directory
WORKDIR /var/www

# Copy application files
COPY . .

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Configure Nginx
COPY docker/nginx.conf /etc/nginx/conf.d/default.conf

# Expose Railway port
EXPOSE 8080

# Start PHP-FPM and Nginx together
CMD php-fpm -D && nginx -g "daemon off;"