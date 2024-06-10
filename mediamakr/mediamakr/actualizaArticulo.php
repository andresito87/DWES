<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location:administracion.php");
}
extract($_POST);
require_once("conectar.php");
//Miramos a ver si debemos cambiar la foto//
//Para ello buscamos la foto actual y la comparamos siempre que no llegue el archivo vacio//

if ($_FILES['imagen']['name'] != "") {
    $data = $cnx->query("SELECT Foto FROM articulos WHERE IDArticulo = $id");
    $row = $data->fetch_assoc();
    extract($row);
    $ruta = "pictures/";
    if (!file_exists($ruta)) {
        mkdir($ruta);
    }
    $miRuta = $ruta . basename($_FILES['imagen']['name']);
    if ($foto != $miRuta) {
        //Pasamos a subir la nueva foto//
        $miRuta = $ruta . basename($_FILES['imagen']['name']);
        if ($_FILES['imagen']['size'] > 20971520) {
            echo "Archivo de Foto Demasiado Grande";
        } elseif ($_FILES['imagen']['type'] != "image/png" && $_FILES['imagen']['type'] != "image/jpg" && $_FILES['imagen']['type'] != "image/jpeg") {
            echo "Tipo de archivo no permitido";
        } elseif (move_uploaded_file($_FILES['imagen']['tmp_name'], $miRuta)) {
            //Pasamos a eliminar la vieja foto//
            unlink($Foto);
            //Actualizamos datos//
            $data = $cnx->prepare("UPDATE articulos SET NombreArticulo = ?, PrecioArticulo = ?, Oferta = ?, PrecioOferta = ?, Foto = ?, Observaciones = ?, ArticuloActivo = ?, Familia = ? WHERE IDArticulo = ?");
            $data->bind_param("sssssssss", $nombreArticulo, $precioArticulo, $oferta, $precioOferta, $miRuta, $observaciones, $activo, $familiaArticulo, $id);
            $data->execute();
            if ($data->error) {
                echo $data->error;
            } else {
                echo 0;
            }
        }
    } else {
        $data = $cnx->prepare("UPDATE articulos SET NombreArticulo = ?, PrecioArticulo = ?, Oferta = ?, PrecioOferta = ?, Observaciones = ?, ArticuloActivo = ?, Familia = ? WHERE IDArticulo = ?");
        $data->bind_param("ssssssss", $nombreArticulo, $precioArticulo, $oferta, $precioOferta, $observaciones, $activo, $familiaArticulo, $id);
        $data->execute();
        if ($data->error) {
            echo $data->error;
        } else {
            echo 0;
        }
    }
} else {
    $data = $cnx->prepare("UPDATE articulos SET NombreArticulo = ?, PrecioArticulo = ?, Oferta = ?, PrecioOferta = ?, Observaciones = ?, ArticuloActivo = ?, Familia = ? WHERE IDArticulo = ?");
    $data->bind_param("ssssssss", $nombreArticulo, $precioArticulo, $oferta, $precioOferta, $observaciones, $activo, $familiaArticulo, $id);
    $data->execute();
    if ($data->error) {
        echo $data->error;
    } else {
        echo 0;
    }
}
