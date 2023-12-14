<?php

if (!isset($_SESSION['dni'])) {
    session_start();
}
if (isset($_SESSION['dni'])) {
    session_destroy(); // destruimos la sesión
    header("Location: ./login.php"); // Redirigimos al usuario a la página de login
}