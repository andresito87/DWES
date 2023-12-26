<?php

if (!isset($_SESSION)) {
    session_start(); // Iniciamos la sesión
}
//Comprobamos si el usuario lleva más de 120 segundos inactivo
$error = "";
if (isset($_SESSION['ultimo_acceso']) && (time() - $_SESSION['ultimo_acceso'] > MAXIMA_INACTIVIDAD)) {
    // Si ha pasado el tiempo de inactividad, destruye la sesión y vuelve al login
    require 'logout.php';
    header("Location: ./login.php"); // Redirigimos al usuario a la página de login
} else if (isset($_SESSION['dni'])) {
    // Si ha pasado la mitad del tiempo de inactividad, actualizamos el tiempo de la sesión
    $error = "El empleado ya está autenticado";
    $_SESSION['ultimo_acceso'] = time();
} else {
    $_SESSION['ultimo_acceso'] = time();
}

return $error;
?>