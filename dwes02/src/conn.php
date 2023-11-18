<?php
require_once 'etc/conf.php';

/**
 * @description Funcion para conectar a la base de datos
 * @file conn.php
 * @return PDO si la conexion se realiza correctamente o muestra un mensaje de error y termina la ejecución del script
 * @author andres
 * @date 2023/11/18
 */
function connect(): PDO
{
    try {
        $DSN = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";port=" . DB_PORT;
        $opciones = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
        $conn = new PDO($DSN, DB_USER, DB_PASS, $opciones);
    } catch (PDOException $e) {
        $error = $e->getMessage();
        die("Error de conexión a la Base de Datos: $error");
    }
    return $conn;
}