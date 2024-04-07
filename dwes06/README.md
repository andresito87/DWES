## DWES: Tarea Unidad 6

**Titulación:** Grado Superior en Desarrollo de Aplicaciones Web

**Asignatura:** Desarrollo Web en Entorno Servidor

**Curso:** 2º

**Tema:** Unidad 6 - Servicios Web en PHP

**Descripción:** Se pide la implementación de un servicio web(API-Rest) que gestione talleres y sus ubicaciones, probarla con Postman y además, una aplicación cliente que consuma dicho servicio. Me auto impongo documentar la API-Rest con Swagger.

## Contenido

1. [Dwes06Servicio](dwes06Servicio)
2. [Dwes06Cliente](dwes06Cliente)
3. [Documentacion API](http://127.0.0.1:8000/api/documentation/)
4. [Colección endpoints de la Api para uso en Postman](Postman)

## Instrucciones de uso

- La carpeta `dwes06Servicio` contiene el servicio web creado con Laravel que gestiona talleres y ubicaciones. Desde la carpeta raíz del proyecto, se puede ejecutar el comando `php artisan serve` para iniciar el servidor local de Laravel y tener acceso a la API-Rest.
- La carpeta `dwes06Cliente` contiene la aplicación cliente que consume el servicio web. Se recomienda que se use desde un servidor local como XAMPP.
- Para su correcto funcionamiento, se debe crear una base de datos MySQL con el nombre `respira_laravel`, ejecutar las migraciones y los seeders del proyecto Laravel con el comando `php artisan migrate --seed`.
- En la ruta `http://127.0.0.1:8000/api/documentation/` se encuentra la documentación de la API-Rest generada con Swagger.
- En la carpeta `Postman` se encuentra un archivo JSON con la colección de peticiones a la API-Rest para ser importado en Postman y poder probar el servicio web.
- El archivo `Comando Artisan.txt` contiene los comandos de Artisan necesarios para la creación de modelos, controladores, migraciones, factorias, seeders. Además, se incluyen los comandos para la ejecucion de los test de la API-Rest (los test no son mi enfoque principal, en esta tarea).

## Tecnologías y programas utilizados

- Laravel
- PHP
- MySQL
- HTML
- CSS
- Postman
- Swagger
- PHP Unit
- Visual Studio Code
- XAMPP
- Composer
- MySQL Workbench
- Git
- GitHub

## Autor

- Nombre: Andrés Samuel Podadera González
- Email: andrespodadera87@gmail.com
- GitHub: [andresito87](https://github.com/andresito87)

## Licencia

[MIT](https://opensource.org/licenses/MIT)
