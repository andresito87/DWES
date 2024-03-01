# Ejecucion de tests de la aplicacion

```bash
./run.tests.sh
```

Una vez ejecutado el script, se generará un archivo llamado "testdox.html" en el directorio /reports con el resultado de los tests.

# Despliegue de la Aplicación Dockerizada

Este repositorio contiene una aplicación dockerizada para facilitar su despliegue y ejecución en cualquier entorno compatible con Docker.

## Requisitos Previos

- Docker: [Instalación de Docker](https://docs.docker.com/get-docker/)
- Docker Compose: [Instalación de Docker Compose](https://docs.docker.com/compose/install/)

## Despliegue de la Aplicación

### La carpeta dwes04DepliegueDocker contiene el docker-compose.yml para desplegar la aplicación en un entorno de producción.(Tiempo estimado de despliegue: 1 minuto a 2 minutos. Habría que eliminar archivos, modificar configuraciones y limpiar los tests de la aplicación que no se utilizan en producción) También habría que crear un archivo .env con variables de entorno y configurar la ip del contenedor del servidor Apache para que sea accesible desde el exterior. Ahora mismo la aplicación se despliega y es accesible desde el localhost.

```bash
docker-compose up [-d]
```

## Acceso a la Aplicación

Una vez desplegada la aplicación, se puede acceder a ella a través de un navegador web en la siguiente URL:
http://localhost/index.php

## Construcción de la Aplicación y subida a Docker Hub

```bash
docker build -t andres87/dwes04-web .
docker push andres87/dwes04-web
```

## Localización de la Aplicación

Repositorio de Docker Hub: [andres87/dwes04-web](https://hub.docker.com/r/andres87/dwes04-web) Latest será la última versión subida a Docker Hub.

## Parada y Eliminación de la Aplicación

```bash
docker-compose down
docker rmi andres87/dwes04-web
```

## Licencia

[MIT](https://choosealicense.com/licenses/mit/)
