FROM php:8.1-apache

# Install necessary extensions
RUN docker-php-ext-install pdo pdo_mysql mbstring

WORKDIR /var/www/html

# Copy Composer
COPY composer.json composer.lock ./
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install project dependencies
RUN composer install --no-interaction --optimize-autoloader --no-dev

# Copy the rest of the application code
COPY . .

# Enable Apache rewrite module
RUN a2enmod rewrite

#Set up Apache Configuration (crucial!)
COPY apache2.conf /etc/apache2/sites-available/000-default.conf
RUN a2ensite 000-default.conf
RUN a2dissite 000-default

#Expose port 8080
EXPOSE 8080

#Set CMD to start Apache
CMD ["apache2-foreground"]

#Crucial Note on apache2.conf : You MUST create an apache2.conf file in the root of your project alongside your Dockerfile . This file will configure Apache to serve your Laravel application correctly. It should include directives to point to your application's public directory and enable necessary modules.
