<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location:administracion.php");
}
extract($_POST);
//Subir el archivo//
if ($_FILES['imagen']['name'] != "") {
    $ruta = "pictures/";
    if (!file_exists($ruta)) {
        mkdir($ruta);
    }
    $miRuta = $ruta . basename($_FILES['imagen']['name']);
    if ($_FILES['imagen']['size'] > 2097152) {
        echo "Archivo de Foto Demasiado Grande";
    } elseif ($_FILES['imagen']['type'] != "image/png" && $_FILES['imagen']['type'] != "image/jpg" && $_FILES['imagen']['type'] != "image/jpeg") {
        echo "Tipo de archivo no permitido";
    }
    elseif(move_uploaded_file($_FILES['imagen']['tmp_name'],$miRuta)) {
        require_once("conectar.php");
        $data = $cnx->prepare("INSERT INTO articulos (NombreArticulo,PrecioArticulo,Oferta,PrecioOferta,Foto,Observaciones,ArticuloActivo,Familia) VALUES (?,?,?,?,?,?,?,?)");
        $data->bind_param("ssssssss",$nombreArticulo,$precioArticulo,$oferta,$precioOferta,$miRuta,$observaciones,$activo,$familiaArticulo);
        $data->execute();
        if ($data->error) {
            echo $data->error;
        }
        else {
            echo "OK";
        }
    }
    else {
        echo "Error al subir el archivo";
    }
}
