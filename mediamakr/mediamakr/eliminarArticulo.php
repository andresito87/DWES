<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location:administracion.php");
}
extract($_POST);
require_once("conectar.php");
$data = $cnx->query("SELECT foto FROM articulos WHERE IDArticulo = $identificador");
$row = $data->fetch_assoc();
extract($row);
if ($foto != "") {
    unlink($foto);
    // borrar archivos del servidor
}
$cnx->query("DELETE FROM articulos WHERE IDArticulo = $identificador");
?>