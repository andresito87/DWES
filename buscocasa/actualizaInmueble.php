<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location:conexion.php");
}
extract($_POST);
require_once("conexion.php");
//Miramos a ver si debemos cambiar la foto//
//Para ello buscamos la foto actual y la comparamos siempre que no llegue el archivo vacio//

if ($_FILES['Foto']['name'] != "") {
    $data = $cnx->query("SELECT Foto FROM inmuebles WHERE IDInmueble = $IdInmueble");
    $row = $data->fetch_assoc();
    extract($row);
    $ruta = "pictures/";
    if (!file_exists($ruta)) {
        mkdir($ruta);
    }
    $miRuta = $ruta . basename($_FILES['Foto']['name']);
    if ($Foto != $miRuta) {
        //Pasamos a subir la nueva foto//
        $miRuta = $ruta . basename($_FILES['Foto']['name']);
        if ($_FILES['Foto']['size'] > 20971520) {
            echo "Archivo de Foto Demasiado Grande";
        } elseif ($_FILES['Foto']['type'] != "image/png" && $_FILES['Foto']['type'] != "image/jpg" && $_FILES['Foto']['type'] != "image/jpeg") {
            echo "Tipo de archivo no permitido";
        } elseif (move_uploaded_file($_FILES['Foto']['tmp_name'], $miRuta)) {
            //Pasamos a eliminar la vieja foto//
            unlink($Foto);
            //Actualizamos datos//
            $data = $cnx->prepare("UPDATE inmuebles SET Calle = ?, Ciudad = ?, CP= ?, IDProvincia = ?, MetrosCuadrados= ?, NumHabitaciones = ?, NumServicios = ?, PeriodoConstruccion = ?,Foto=?,LinkMaps=?,SituacionInmueble=?,PrecioAlquiler=?,PrecioVenta=?,NRefCat=?,Reservado=?,FechaReserva=?,ImporteReserva=? WHERE IDInmueble = ?");
            $data->bind_param("ssssssssssssssssss",$calle,$ciudad,$cp,$IDProvincia,$MetrosCuadrados,$NumHabitaciones,$NumServicios,$PeriodoConstruccion,$miRuta,$LinkMaps,$SituacionInmueble,$precioalquiler,$precioventa,$NRefCat,$reservado,$fechareserva,$importereserva,$IdInmueble);
            $data->execute();
            if ($data->error) {
                echo $data->error;
            } else {
                echo 0;
            }
        }
    } else {
        $data = $cnx->prepare("UPDATE inmuebles SET Calle = ?, Ciudad = ?, CP= ?, IDProvincia = ?, MetrosCuadrados= ?, NumHabitaciones = ?, NumServicios = ?, PeriodoCOnstruccion = ?,Foto=?,LinkMaps=?,SituacionInmueble=?,PrecioAlquiler=?,PrecioVenta=?,NRefCat=?,Reservado=?,FechaReserva=?,ImporteReserva=? WHERE IDInmueble = ?");
        $data->bind_param("ssssssssssssssssss",$calle,$ciudad,$cp,$IDProvincia,$MetrosCuadrados,$NumHabitaciones,$NumServicios,$PeriodoConstruccion,$miRuta,$LinkMaps,$SituacionInmueble,$precioalquiler,$precioventa,$NRefCat,$reservado,$fechareserva,$importereserva,$IdInmueble);
        $data->execute();
        if ($data->error) {
            echo $data->error;
        } else {
            echo 0;
        }
    }
} else {
    $data = $cnx->prepare("UPDATE inmuebles SET Calle = ?, Ciudad = ?, CP= ?, IDProvincia = ?, MetrosCuadrados= ?, NumHabitaciones = ?, NumServicios = ?, PeriodoCOnstruccion = ?,Foto=?,LinkMaps=?,SituacionInmueble=?,PrecioAlquiler=?,PrecioVenta=?,NRefCat=?,Reservado=?,FechaReserva=?,ImporteReserva=? WHERE IDInmueble = ?");
    $data->bind_param("sssssssssssssssss",$calle,$ciudad,$cp,$IDProvincia,$MetrosCuadrados,$NumHabitaciones,$NumServicios,$PeriodoConstruccion,$miRuta,$LinkMaps,$SituacionInmueble,$precioalquiler,$precioventa,$NRefCat,$reservado,$fechareserva,$importereserva,$IdInmueble);
    $data->execute();
    if ($data->error) {
        echo $data->error;
    } else {
        echo 0;
    }
}
