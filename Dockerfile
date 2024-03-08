FROM php:5.6-apache

# Habilita mod_rewrite para Apache
RUN a2enmod rewrite

# Aumenta el límite de memoria de PHP
RUN echo "memory_limit = 512M" >> /usr/local/etc/php/conf.d/memory-limit.ini

# Instala las extensiones de PHP que necesites
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Copia tu aplicación al contenedor
COPY . /var/www/html/
