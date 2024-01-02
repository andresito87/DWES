<?php
require_once './etc/conf.php';

if (!isset($_SESSION)) {
    session_start(); // Iniciamos la sesión
}
if (isset($_SESSION['auth'])) {
    //Comprobamos si el usuario lleva más de 120 segundos inactivo
    if (isset($_SESSION['ultimo_acceso']) && (time() - $_SESSION['ultimo_acceso'] > MAXIMA_INACTIVIDAD)) {
        // Si ha pasado el tiempo de inactividad, destruye la sesión y vuelve al login
        header('Location: ./logout.php');
    } else if (isset($_SESSION['ultimo_acceso']) && isset($_SESSION['auth'])) {
        $_SESSION['ultimo_acceso'] = time();
    } else {
        $_SESSION['ultimo_acceso'] = time();
    }
} else {
    //Cualquier usuario que no esté autenticado, será redirigido al login
    header("Location: ./login.php");
    exit;
}
?>