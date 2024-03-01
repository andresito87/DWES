#!/bin/bash

# Instala las dependencias con Composer
composer install --no-interaction

# Cambia los permisos recursivamente en el directorio
chmod -R 777 /var/www/html/plantillas_c

# Inicia el servidor Apache
apache2-foreground