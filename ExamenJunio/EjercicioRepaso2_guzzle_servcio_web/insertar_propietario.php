<?php
require_once __DIR__ . '/conectar.php';

if (! empty($_POST)) {

    $datosEsperados = ['nombre', 'apellidos', 'edad'];

    //if (isset($_POST['nombre']) && isset($_POST['apellidos']) && isset($_POST['edad']))
    $keysRecibidos = array_keys($_POST);
    $errores = [];
    if (empty(array_diff($keysRecibidos, $datosEsperados))) {
        if (! empty($_POST['nombre']) && strlen($_POST['nombre']) < 50)
            $old['nombre'] = $_POST['nombre'];
        else
            $errores[] = "El dato nombre no es válido";
        if (! empty($_POST['apellidos']) && strlen($_POST['apellidos']) < 50)
            $old['apellidos'] = $_POST['apellidos'];
        else
            $errores[] = "El dato apellido no es válido";
        if (
            ! empty($_POST['edad']) && is_numeric($_POST['edad']) &&
            $_POST['edad'] > 0 && $_POST['edad'] <= 99
        )
            $old['edad'] = $_POST['edad'];
        else
            $errores[] = "El dato edad no es válido";
    }
}
if (isset($errores) && empty($errores) && isset($old)) {
    $sql = "INSERT INTO propietarios (nombre, apellidos, edad) values (:nombre, :apellidos, :edad)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue('nombre', $old['nombre']);
    $stmt->bindValue('apellidos', $old['apellidos']);
    $stmt->bindValue('edad', $old['edad'], PDO::PARAM_INT);
    $stmt->execute();
    if ($stmt->rowCount() === 1) {
        echo "Propietario insertado";
    } else {
        echo "Propietario NO insertado. Problemas.";
    }
} else {
    include 'formpropietario.php';
}
