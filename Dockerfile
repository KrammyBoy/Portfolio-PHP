FROM php:8.2-fpm

# Install system dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    nginx \
    unzip \
    git \
    curl \
    libpq-dev \
    && rm -rf /var/lib/apt/lists/*

# Install PostgreSQL PDO extension
RUN docker-php-ext-install pdo pdo_pgsql

# PHP upload limits
RUN echo "upload_max_filesize = 50M" >> /usr/local/etc/php/php.ini \
    && echo "post_max_size = 50M" >> /usr/local/etc/php/php.ini

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set working directory
WORKDIR /var/www

# Copy application files
COPY src/ /var/www/

# (Optional) Install PHP dependencies
# RUN composer install --no-dev --optimize-autoloader

# Configure Nginx
COPY docker/nginx/nginx.conf /etc/nginx/conf.d/default.conf

# Expose Railway port
EXPOSE 8080

# Create Directory for images/upload
RUN mkdir -p /var/www/public/assets/upload/images \ 
    && mkdir -p /var/www/public/assets/upload/certificates

# Start PHP-FPM and Nginx together
CMD chown -R www-data:www-data /var/www/public/assets/upload \
    && chmod -R 755 /var/www/public/assets/upload \
    && php-fpm -D && nginx -g "daemon off;"

