<?php
require_once("parametros.php");
$cnx = new mysqli(HOSTNAME,USER,PWD,BD);
if ($cnx->connect_error) {
    die("Me paro por ". $cnx->connect_error);

}
// para arreglar problema de caracteres al subir el archivo
$cnx->set_charset("utf8");