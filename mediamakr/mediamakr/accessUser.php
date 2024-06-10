<?php
session_start();
require_once("errores.php");
require_once("conectar.php");
extract($_POST);
$data = $cnx->query("SELECT * FROM administradores WHERE usuario LIKE '$user' AND password LIKE SHA1('$pwd')");
if ($data->num_rows > 0) {
    $row = $data->fetch_assoc();
    $_SESSION['usuario'] = $row['usuario'];
    $_SESSION['nombre'] = $row['nombre'];
}
echo $data->num_rows;