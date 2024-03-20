# Proyecto Laravel/Vue/Inertia.js

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center"><a href="https://vuejs.org/" target="_blank"><img src="https://vuejs.org/images/logo.png" width="150" alt="Vue Logo"></a></p>

<p align="center"><a href="https://inertiajs.com/" target="_blank"><img src="https://raw.githubusercontent.com/inertiajs/.github/master/LOGO.png" width="300" alt="Inertia Logo"></a></p>

## Descripción

Este proyecto es una aplicación web desarrollada con el framework Laravel. La aplicación permite gestionar una base de datos de talleres y ubicaciones(CRUD). Cada taller tiene una ubicación asociada. La aplicación permite realizar las siguientes operaciones:

-   Listar ubicaciones.
-   Mostrar el detalle de una ubicación.
-   Crear ubicaciones.
-   Editar ubicaciones.
-   Eliminar ubicaciones.
-   Listar talleres.
-   Mostrar el detalle de un taller.

## Instalación

-   Crear una base de datos en MySQL con el siguiente nombre:

        respira_laravel

-   php artisan migrate:fresh
-   php artisan db:seed
-   php artisan serve

## Uso/Rutas

-   Pantalla de Bienvenida: [http://127.0.0.1:8000/](http://127.0.0.1:8000/)
-   Listar ubicaciones: [http://127.0.0.1:8000/ubicaciones](http://127.0.0.1:8000/ubicaciones)
-   Detalle de ubicación: [http://127.0.0.1:8000/ubicaciones/2](http://127.0.0.1:8000/ubicaciones/2)
-   Crear ubicaciones: [http://127.0.0.1:8000/ubicaciones/create](http://127.0.0.1:8000/ubicaciones/create)
-   Editar ubicaciones: [http://127.0.0.1:8000/ubicaciones/2/edit](http://127.0.0.1:8000/ubicaciones/2/edit)
-   Eliminar ubicaciones: [http://127.0.0.1:8000/ubicaciones/2/destroyconfirm](http://127.0.0.1:8000/ubicaciones/2/destroyconfirm)
-   Listar Talleres: [http://127.0.0.1:8000/talleres](http://127.0.0.1:8000/talleres)
-   Detalle de Taller: [http://127.0.0.1:8000/talleres/1](http://127.0.0.1:8000/talleres/1)

## Imágenes

-   Pantalla de Bienvenida

    ![Pantalla de Bienvenida](public/img/1.png)

-   Listar ubicaciones

    ![Listar ubicaciones](public/img/2.png)

-   Detalle de ubicación

    ![Detalle de ubicación](public/img/3.png)

-   Crear ubicaciones

    ![Crear ubicaciones](public/img/4.png)

-   Editar ubicaciones

    ![Editar ubicaciones](public/img/5.png)

-   Eliminar ubicaciones

    ![Eliminar ubicaciones](public/img/6.png)

-   Listar Talleres

    ![Listar Talleres](public/img/7.png)

-   Detalle de Taller

    ![Detalle de Taller](public/img/8.png)

## Tests

-   Crear una base de datos en MySQL con el siguiente nombre:

          respira_laravel_testing

-   php artisan migrate --env=testing
-   php artisan test (ejecuta todos los tests unitarios y de características)
-   php artisan test --testsuite=Feature
-   php artisan test --testsuite=Unit

    **Regression Testing**

    Para usar Dusk, es necesario descomentar la siguiente línea en el archivo en C:\\xamp\php\php.ini

    -   ;extension=zip

    Sino dará error al hacer el composer install o update ya que no podrá instalar el paquete de Dusk.

    Instalacion del Driver de Chrome para realizar las pruebas de Dusk

    -   php artisan dusk:install

    Ejecutar los tests de Dusk

    -   php artisan dusk

## Autor

**Andrés Podadera** - [Perfil Github](https://github.com/andresito87)

## Licencia

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
