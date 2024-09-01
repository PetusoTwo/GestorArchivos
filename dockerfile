# release phase
COPY . /app/.
WORKDIR /app

# Asegurar permisos de ejecución para deploy.sh
RUN chmod +x /app/deploy.sh

# Ejecutar el script de despliegue
RUN /app/deploy.sh
