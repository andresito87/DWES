<?php

define('DB_HOST', 'database');
define('DB_NAME', 'docker');
define('DB_USER', 'root');
define('DB_PASS', 'tiger');
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

function obtenerContrasena($con, $nombreUsuario): array|bool
{
    $sql = "SELECT nombre,contrasena FROM usuarios WHERE nombre = :nombreUsuario";
    $stmt = $con->prepare($sql);
    $stmt->bindParam(':nombreUsuario', $nombreUsuario);
    $contrasena = false;
    try {
        $stmt->execute();
        $contrasena = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die($e->getMessage());
    }
    return $contrasena;
}
