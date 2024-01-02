<?php

// Recuperamos la información de la sesión
if (!isset($_SESSION)) {
    session_start();
}

if (isset($_SESSION['auth'])) {
    session_unset(); // Y la eliminamos
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./styles/estilosLogout.css" rel="stylesheet" type="text/css">
    <title>Respira - Salir</title>
</head>

<body>
    <a href="./login.php">Volver a la página de login del portal de empleado de la Asociación Respira</a>
</body>

</html>