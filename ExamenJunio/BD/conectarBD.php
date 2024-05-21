<?php
define('DBNAME', 'dwes04tarea');
define('DBHOST', 'localhost');
define('DBPORT', '3306');
define('DBUSER', 'root');
define('DBPASSWORD', '');

try {
    $pdo = new PDO(sprintf('mysql:dbname=%s;host=%s;port=%s', DBNAME, DBHOST, DBPORT), DBUSER, DBPASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $pdo;
} catch (PDOException) {
    die("No se pudo conectar con la base de datos");
}


