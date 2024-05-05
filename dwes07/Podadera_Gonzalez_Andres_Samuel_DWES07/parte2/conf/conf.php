<?php

/* Configuracion MySQL en Docker: 
define('DB_DSN', 'mysql:host=database;dbname=dwes07');
define('DB_USER', 'root');
define('DB_PASSWD', 'tiger');*/

/* Configuracion MySQL en XAMPP:
define('DB_DSN', 'mysql:host=localhost;dbname=dwes07');
define('DB_USER', 'root');
define('DB_PASSWD', '');*/

define('DB_DSN', 'mysql:host=database;dbname=dwes07');
define('DB_USER', 'root');
define('DB_PASSWD', 'tiger');
define('SALT', '495k5ndikakzFSKZssd');

if (! defined('DB_USER') || ! defined('DB_PASSWD')) {
    die("<H1>Configura en " . __FILE__ . " las constantes DB_USER y DB_PASSWD");
}
