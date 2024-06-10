<?php
session_start();
extract($_POST);
require_once("conexion.php");
$data = $cnx->query("SELECT login,nombre FROM administradores WHERE login LIKE '$login' AND password LIKE SHA1('$pwd')");
if ($data->num_rows > 0) {
    $row = $data->fetch_assoc();
    $_SESSION['login'] = $row['login'];
    $_SESSION['nombre'] = $row['nombre'];
    
}
echo $data->num_rows;