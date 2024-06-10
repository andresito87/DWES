<?php
//session_start();
// if (!isset($_SESSION['login'])) {
//     header("Location:admin.php");
// }
require_once("conexion.php");
extract($_POST);
$datos = array();
if ($provinciaBuscada == 0) {
    $SQL = "SELECT IDProvincia,Calle,Foto,SituacionInmueble,PrecioAlquiler,PrecioVenta FROM inmuebles ORDER BY IDProvincia";
} else {
    $SQL = "SELECT  IDProvincia,Calle,Foto,SituacionInmueble,PrecioAlquiler,PrecioVenta FROM inmuebles WHERE IDProvincia=$provinciaBuscada ORDER BY IDProvincia";
}
$data = $cnx->query($SQL);
while ($row = $data->fetch_assoc()) {
    extract($row);
    $datos[] = array(
        'id'            =>   $IDProvincia,
        'calle'        =>   $Calle,
        'foto'          =>   $Foto,
        'situacion'        =>   $SituacionInmueble,
        'precioalquiler'        =>   number_format($PrecioAlquiler, 2, ",", "."),
        'precioventa'  =>   number_format($PrecioVenta, 2, ",", ".")
    );
}
echo json_encode($datos);
