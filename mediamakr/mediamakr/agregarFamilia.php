<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location:administracion.php");
}
extract($_POST);
require_once("conectar.php");
$data = $cnx->prepare("INSERT INTO familias (NombreFamilia) VALUES (?)");
$data->bind_param("s",$familia);
$data->execute();
if ($data->error) {
    echo "null";
}
else {
    $data = $cnx->query("SELECT LAST_INSERT_ID() as ultimo FROM familias");
    $row = $data->fetch_assoc();
    extract($row);
    echo $ultimo;
}