#!/bin/bash

# Ejecutar migraciones
php artisan migrate --force

# Crear superusuario si la variable de entorno está presente
if [ "$CREATE_SUPER_ADMIN" = "true" ]; then
  php artisan shield:super-admin --name="Administrador" --email="$SUPER_ADMIN_EMAIL" --password="$SUPER_ADMIN_PASSWORD" --force
fi
