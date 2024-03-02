<?php

//Configuración Base de Datos
define('DB_DSN', 'mysql:host=db;dbname=dwes04tarea'); //Cambiar por 'mysql:host=localhost;dbname=dwes04tarea' si usamos XAMPP
define('DB_USER', 'root');
define('DB_PASSWORD', 'root'); //Cambiar por '' si usamos XAMPP

//Configuración Smarty
define('TEMPLATE_DIR', '/plantillas');
define('TEMPLATE_C_DIR', '/plantillas_c');
define('CACHE_DIR', '/cache');