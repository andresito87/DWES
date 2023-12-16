<?php

// Recuperamos la información de la sesión
session_start();

if (isset($_SESSION['dni'])) {
    session_unset(); // Y la eliminamos
    header("Location: ./login.php"); // Redirigimos al usuario a la página de login
}