# Ejecucion de tests de la aplicacion

```bash
./run.tests.sh
```

# Despliegue de la Aplicación Dockerizada

Este repositorio contiene una aplicación dockerizada para facilitar su despliegue y ejecución en cualquier entorno compatible con Docker.

## Requisitos Previos

- Docker: [Instalación de Docker](https://docs.docker.com/get-docker/)
- Docker Compose: [Instalación de Docker Compose](https://docs.docker.com/compose/install/)

## Despliegue de la Aplicación

### La carpeta dwes04DepliegueProfesor contiene el docker-compose.yml para desplegar la aplicación en un entorno de producción.(Tiempo estimado de despliegue: 1 minuto a 2 minutos. Se podría mejorar el tiempo de despliegue si se utilizara un servidor web más ligero como Nginx. Habría que eliminar archivos, configuraciones y test de la aplicación que no se utilizan en producción)

```bash
docker-compose up [-d]
```

## Construcción de la Aplicación y subida a Docker Hub

```bash
docker build -t andres87/dwes04-web .
docker push andres87/dwes04-web
```

## Localización de la Aplicación

Repositorio de Docker Hub: [andres87/dwes04-web](https://hub.docker.com/r/andres87/dwes04-web) Latest será la última versión subida a Docker Hub.

## Acceso a la Aplicación

Una vez desplegada la aplicación, se puede acceder a ella a través de un navegador web en la siguiente URL:
http://localhost/index.php

## Parada y Eliminación de la Aplicación

```bash
docker-compose down
docker rmi andres87/dwes04-web
```

## Licencia

[MIT](https://choosealicense.com/licenses/mit/)
