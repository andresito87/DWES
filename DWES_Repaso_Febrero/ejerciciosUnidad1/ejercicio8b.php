<?php

if (isset($_GET['nombre']) && isset($_GET['apellido']) && isset($_GET['edad'])) {
    $nombre = $_GET['nombre'];
    $apellido = $_GET['apellido'];
    $edad = $_GET['edad'];
    echo "Nombre: " . urldecode($nombre) . "<br>";
    echo "Apellido: " . urldecode($apellido) . "<br>";
    echo "Edad: " . urldecode($edad) . "<br>";
} else {
    echo "No se han recibido datos";
}