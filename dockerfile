# Use PHP with Apache
FROM php:8.2-apache

# Install MySQL extension for PHP
RUN docker-php-ext-install pdo pdo_mysql

# Enable Apache mod_rewrite if needed
RUN a2enmod rewrite

# Copy source code into container
COPY src/ /var/www/html/

# Set permissions
RUN chown -R www-data:www-data /var/www/html

# Expose port 80
EXPOSE 80
