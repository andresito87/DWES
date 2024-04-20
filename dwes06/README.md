## DWES: Tarea Unidad 6

**Titulación:** Grado Superior en Desarrollo de Aplicaciones Web

**Asignatura:** Desarrollo Web en Entorno Servidor

**Curso:** 2º

**Tema:** Unidad 6 - Servicios Web en PHP

**Descripción:** Se pide la implementación de un servicio web(API-Rest) que gestione talleres y sus ubicaciones, probarla con Postman y además, una aplicación cliente que consuma dicho servicio. Me auto impongo documentar la API-Rest con Swagger, testearla y crear una aplicación cliente con React que consuma dicha API.

## Contenido

1. [Dwes06Servicio](dwes06Servicio)
2. [Dwes06Cliente](dwes06Cliente)
3. [Documentacion API](http://127.0.0.1:8000/api/documentation/)
4. [Colección endpoints de la Api para uso en Postman](Postman)
5. [Aplicación cliente React](react)

## Instrucciones de uso

- La carpeta `dwes06Servicio` contiene el servicio web creado con Laravel que gestiona talleres y ubicaciones. Desde la carpeta raíz del proyecto, se puede ejecutar el comando `php artisan serve` para iniciar el servidor local de Laravel y tener acceso a la API-Rest.
- La carpeta `dwes06Cliente` contiene la aplicación cliente que consume el servicio web. Se recomienda que se use desde un servidor local como XAMPP.
- Para su correcto funcionamiento, se debe crear una base de datos MySQL con el nombre `respira_laravel`, ejecutar las migraciones y los seeders del proyecto Laravel con el comando `php artisan migrate --seed`.
- En la ruta `http://127.0.0.1:8000/api/documentation/` se encuentra la documentación de la API-Rest generada con Swagger.
- En la carpeta `Postman` se encuentra un archivo JSON con la colección de peticiones a la API-Rest para ser importado en Postman y poder probar el servicio web.
- En la carpteta `react` se encuentra una aplicación cliente creada con React que consume el servicio web. Para su correcto funcionamiento, se debe ejecutar el comando `npm install` para instalar las dependencias y luego `npm run dev` para iniciar el servidor local de React.
- El archivo `Comando Artisan.txt` contiene los comandos de Artisan necesarios para la creación de modelos, controladores, migraciones, factorias, seeders. Además, se incluyen los comandos para la ejecucion de los test de la API-Rest (los test no son mi enfoque principal, en esta tarea).

## Tecnologías y programas utilizados

- Laravel: [Descargar Laravel](https://laravel.com/)
- React: [Descargar React](https://es.reactjs.org/)
- PHP: [Descargar PHP](https://www.php.net/downloads)
- MySQL: [Descargar MySQL](https://www.mysql.com/downloads/)
- HTML: [Documentacion HTML](https://developer.mozilla.org/es/docs/Web/HTML)
- CSS: [Documentacion CSS](https://developer.mozilla.org/es/docs/Web/CSS)
- Postman: [Descargar Postman](https://www.postman.com/downloads/)
- Swagger En Laravel: [L5-Swagger](https://github.com/DarkaOnLine/L5-Swagger)
- PHP Unit: [PHPUnit](https://phpunit.de/index.html)
- Visual Studio Code: [Descargar Visual Studio Code](https://code.visualstudio.com/)
- XAMPP: [Descargar XAMPP](https://www.apachefriends.org/es/index.html)
- Composer: [Descargar Composer](https://getcomposer.org/)
- MySQL Workbench: [Descargar MySQL Workbench](https://www.mysql.com/products/workbench/)
- Git: [Descargar Git](https://git-scm.com/)
- GitHub: [GitHub](https://github.com/)

## Autor

- Nombre: Andrés Samuel Podadera González
- Email: andrespodadera87@gmail.com
- GitHub: [andresito87](https://github.com/andresito87)

## Licencia

[MIT](https://opensource.org/licenses/MIT)
