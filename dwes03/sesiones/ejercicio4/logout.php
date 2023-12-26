<?php

// Recuperamos la información de la sesión
session_start();

if (isset($_SESSION['dni'])) {
    session_unset(); // Y la eliminamos
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Respira - Salir</title>
</head>

<body>
    <a href="./login.php">Volver a la página de login del portal de empleado de la Asociación Respira</a>
</body>

</html>