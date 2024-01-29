<?php

define('DB_HOST', 'localhost');
define('DB_NAME', 'prueba');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_PORT', '3306');


function connect()
{
    $conn = false;
    try {
        $DSN = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";port=" . DB_PORT;
        $opciones = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
        $conn = new PDO($DSN, DB_USER, DB_PASS, $opciones);
    } catch (PDOException $e) {
        $error = $e->getMessage();
        die($error);
    }
    return $conn;
}

return connect();
