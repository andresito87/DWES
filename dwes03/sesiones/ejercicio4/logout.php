<?php
require_once './etc/conf.php';

// Recuperamos la información de la sesión
if (!isset($_SESSION)) {
    session_start();
}

$es_session_expirada = false;
if (isset($_SESSION['ultimo_acceso']) && (time() - $_SESSION['ultimo_acceso'] > MAXIMA_INACTIVIDAD)) {
    $es_session_expirada = true;
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
    <?php
    if ($es_session_expirada) {
        echo "<h2>La sesión ha expirado</h2>";
    } else {
        echo "<h2>La sesión ha sido cerrada</h2>";
    }
    ?>
    <a href="./login.php">Volver a la página de login del portal de empleado de la Asociación Respira</a>
</body>

</html>