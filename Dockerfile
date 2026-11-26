FROM php:8.3-apache
# Instalar y habilitar la extensión mysqli para MariaDB
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli
# Copiar los archivos del proyecto al directorio público de Apache
COPY . /var/www/html/
# Adaptar Apache al puerto dinámico asignado por Render
RUN sed -i 's/80/${PORT}/g' /etc/apache2/sites-available/000-default.conf
/etc/apache2/ports.conf
