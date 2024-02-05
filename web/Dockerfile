# Utilisez une image PHP officielle avec Apache
FROM php:7.4-apache

RUN docker-php-ext-install pdo_mysql

# php apach default work
WORKDIR /var/www/html

# Copiez le contenu de mon application dans le conteneur
COPY . .

# Exposez le port 80 pour permettre l'accès à Apache
EXPOSE 80
