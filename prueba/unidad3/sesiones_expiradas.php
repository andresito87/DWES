<?php
// Iniciamos la sesión o recuperamos la anterior sesión existente
session_start();
// Establecemos el momento en el que el usuario realizo por primera vez una acción
if (!isset($_SESSION['inicio'])) {
    $_SESSION['inicio'] = time();
}
// Comprobamos que hace menos de 60 minutos que se conecto
if ($_SESSION['inicio'] + 3600 > time()) {
    // Acciones en caso de que NO haya expirado la información
    $hora_inicio = date('H:i:s', $_SESSION['inicio']);
    echo "La sesión comenzó a las $hora_inicio";
    echo "<br>";
} else {
    //Acciones en caso de que SI haya expirado la información
    unset($_SESSION['inicio']);
}