<?php

//Si no existe la sesión, la creamos
if (!isset($_SESSION['dni'])) {
    session_start();
}

//Comprobamos si el usuario lleva más de 120 segundos inactivo
if (isset($_SESSION['ultimo_acceso']) && (time() - $_SESSION['ultimo_acceso'] > 5)) {
    // Si ha pasado el tiempo de inactividad, destruye la sesión y vuelve al login
    require 'logout.php';
    header("Location: ./login.php"); // Redirigimos al usuario a la página de login
    exit;
} else {
    $_SESSION['ultimo_acceso'] = time();
}