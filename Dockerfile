FROM php:7.4-apache

# Instala dependencias de PHP y extensiones requeridas por Laravel
RUN apt-get update && apt-get install -y \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    && docker-php-ext-install \
    bcmath \
    ctype \
    fileinfo \
    gd \
    json \
    mbstring \
    pdo \
    pdo_mysql \
    tokenizer \
    xml \
    && a2enmod rewrite

# Copia el archivo de configuración de Apache para habilitar el sitio Laravel
COPY apache2.conf /etc/apache2/sites-available/000-default.conf

# Habilita la reescritura de URLs
RUN sed -ri -e 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf

# Reinicia Apache
RUN service apache2 restart

# Establece el directorio de trabajo
WORKDIR /var/www/html

# Copia los archivos de Laravel al contenedor
COPY . .

#Crea una carpeta para composer
RUN mkdir /usr/local/bin/composer

# Instala Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin/composer --filename=composer

RUN chmod +x /usr/local/bin/composer
#Crea una carpeta para storage
#RUN mkdir /var/www/html/storage

# Asigna los permisos correctos a los archivos de Laravel
RUN chown -R www-data:www-data /var/www/html/storage

#   Instalar git
RUN apt-get update && apt-get install -y git


# Expone el puerto 8000 para acceder a la aplicación Laravel
EXPOSE 8000