# release phase
COPY . /app/.
WORKDIR /app

# Asegurar permisos de ejecución para deploy.sh
RUN chmod +x deploy.sh

# Ejecutar el script de despliegue
RUN ./deploy.sh
