<?php
require_once 'etc/conf.php';
function connect()
{
    $opciones = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
    try {
        $conn = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS, $opciones);
    } catch (PDOException $e) {
        $error = $e->getMessage();
        echo "Error:. $error";
        die();
    }
    return $conn;
}