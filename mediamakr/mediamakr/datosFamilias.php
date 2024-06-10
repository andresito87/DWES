<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location:administracion.php");
}
require_once("conectar.php");
extract($_POST);
$datos = array();
if ($familiaBuscada == 0) {
    $SQL = "SELECT IDArticulo,NombreArticulo,foto,PrecioArticulo,Oferta,PrecioOferta FROM articulos ORDER BY NombreArticulo";
}
else {
    $SQL = "SELECT IDArticulo,NombreArticulo,foto,PrecioArticulo,Oferta,PrecioOferta FROM articulos WHERE FAMILIA = $familiaBuscada ORDER BY NombreArticulo";
}
$data = $cnx->query($SQL);
while ($row = $data->fetch_assoc()) {
    extract($row);
    $datos[] = Array(
        'id'            =>   $IDArticulo,
        'nombre'        =>   $NombreArticulo,
        'foto'          =>   $foto,
        'precio'        =>   number_format($PrecioArticulo,2,",","."),
        'oferta'        =>   $Oferta,
        'precioOferta'  =>   number_format($PrecioOferta,2,",",".")
    );
}
echo json_encode($datos);