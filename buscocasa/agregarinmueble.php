<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location:admin.php");
}
extract($_POST);
//Subir el archivo//
// el campo de files es el primero del append
if ($_FILES['Foto']['name'] != "") {
    $ruta = "pictures/";
    if (!file_exists($ruta)) {
        mkdir($ruta);
    }
    $miRuta = $ruta . basename($_FILES['Foto']['name']);
    if ($_FILES['Foto']['size'] > 20971523) {
        echo "Archivo de Foto Demasiado Grande";
    } elseif ($_FILES['Foto']['type'] != "image/png" && $_FILES['Foto']['type'] != "image/jpg" && $_FILES['Foto']['type'] != "image/jpeg") {
        echo "Tipo de archivo no permitido";
    }
    elseif(move_uploaded_file($_FILES['Foto']['tmp_name'],$miRuta)) {
        require_once("conexion.php");
        $data = $cnx->prepare("INSERT INTO inmuebles (Calle,Ciudad,CP,IDProvincia,MetrosCuadrados,NumHabitaciones,NumServicios,PeriodoConstruccion,Foto,LinkMaps,SituacionInmueble,PrecioAlquiler,PrecioVenta,NRefCat,Reservado,FechaReserva,ImporteReserva) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
        // el bind param coge los valores de la izquierda del append
        $data->bind_param("sssssssssssssssss",$calle,$ciudad,$cp,$IDProvincia,$MetrosCuadrados,$NumHabitaciones,$NumServicios,$PeriodoConstruccion,$miRuta,$LinkMaps,$SituacionInmueble,$precioalquiler,$precioventa,$NRefCat,$reservado,$fechareserva,$importereserva);
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
