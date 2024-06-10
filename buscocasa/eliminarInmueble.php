<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location:admin.php");
}
extract($_POST);
require_once("conexion.php");
$data = $cnx->query("SELECT Foto FROM inmuebles WHERE IDInmueble = $identificador");
$row = $data->fetch_assoc();
extract($row);
if ($foto != "") {
    unlink($foto);
    // borrar archivos del servidor
}
$cnx->query("DELETE FROM inmuebles WHERE IDInmueble = $identificador");
?>