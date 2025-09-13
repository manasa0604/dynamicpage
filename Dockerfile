FROM php:8.1-apache

# Install mysqli extension for MySQL
RUN docker-php-ext-install mysqli

# Copy app
COPY index.php /var/www/html/
