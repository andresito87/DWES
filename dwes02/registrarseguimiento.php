<?php
require 'src/conn.php';
require 'src/dbfuncs.php';

$errores = [];

$idUsuario = filter_input(INPUT_POST, 'idUsuario', FILTER_VALIDATE_INT);
if ($idUsuario === false || !is_int($idUsuario) || trim($idUsuario) === '' || $idUsuario <= 0) {
    $errores[] = "Datos de usuario no válidos";
}

$fechaSeguimiento = filter_input(INPUT_POST, 'fechaSeguimiento', FILTER_SANITIZE_STRING);
if ($fechaSeguimiento !== false && $fechaSeguimiento !== null && trim($fechaSeguimiento) !== '') {
    if ($fechaSeguimiento = DateTime::createFromFormat('d/m/Y', $fechaSeguimiento)) {
        $dia = $fechaSeguimiento->format('d');
        $mes = $fechaSeguimiento->format('m');
        $anio = $fechaSeguimiento->format('Y');
        if (!preg_match("/^\d{2}\/\d{2}\/\d{4}$/", $fechaSeguimiento->format('d/m/Y'))
            || !checkdate($mes, $dia, $anio)) {
            $errores[] = "La fecha de seguimiento no es válida";
        }
    } else {
        $errores[] = "La fecha de seguimiento no es válida";
    }
} else {
    $errores[] = "La fecha de seguimiento no es válida";
}

$horaSeguimiento = filter_input(INPUT_POST, 'horaSeguimiento', FILTER_SANITIZE_STRING);
if ($horaSeguimiento !== false && $horaSeguimiento !== null && trim($horaSeguimiento) !== '') {
    if (!preg_match("/^\d{2}:\d{2}$/", $horaSeguimiento)) {
        $errores[] = "La hora de seguimiento no es válida";
    }
} else {
    $errores[] = "La hora de seguimiento no es válida";
}

$medioSeguimiento = filter_input(INPUT_POST, 'medioSeguimiento', FILTER_SANITIZE_STRING);
if ($medioSeguimiento !== false && $medioSeguimiento !== null && trim($medioSeguimiento) !== '') {
    $mediosValidos = ['TLF', 'EMAIL', 'PRESENCIAL', 'VIDEOCONF', 'OTRO'];
    if (!in_array($medioSeguimiento, $mediosValidos)) {
        $errores[] = "El medio de seguimiento no es válido";
    }
    if ($medioSeguimiento === 'OTRO') {
        $otroMedioSeguimiento = filter_input(INPUT_POST, 'otroMedioSeguimiento', FILTER_SANITIZE_STRING);
        if (!is_string($otroMedioSeguimiento) || trim($otroMedioSeguimiento) === '') {
            $errores[] = "El otro medio de seguimiento no es válido";
        }
    }
} else {
    $errores[] = "El medio de seguimiento no es válido";
}

$pdo = null;
$empleadoSeguimiento = filter_input(INPUT_POST, 'empleadoSeguimiento', FILTER_VALIDATE_INT);
if ($empleadoSeguimiento !== false && $empleadoSeguimiento !== null && trim($empleadoSeguimiento) !== '') {
    $pdo = connect();
    $empleados = listadoCoordinadoresOTrabSociales($pdo);
    if (is_array($empleados) && (empty($empleados) || !array_key_exists($empleadoSeguimiento, $empleados))) {
        $errores[] = "El empleado para ese seguimiento no es válido";
    }
} else {
    $errores[] = "Error en los datos del empleado";
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="styles/estilosRegistrarSeguimiento.css">
    <title>Registar Nuevo Seguimiento</title>
</head>
<body>
<?php
$insertado = -1;
if (empty($errores)) {
    $fechahora = $fechaSeguimiento->format('Y-m-d') . " " . $horaSeguimiento;
    $contactado = false;
    $informe = null;
    $usuariosId = $_POST['idUsuario'];
    $insertado = insertarSeguimientos($pdo, $fechahora, $medioSeguimiento, $otroMedioSeguimiento ?? null, $contactado, $informe, $empleadoSeguimiento, $usuariosId);
    if ($insertado === 1) {
        echo "<p>Se ha creado el seguimiento correctamente</p>";
        echo "<form action='detalleusuario.php' method='post'>";
        echo "<input type='hidden' name='idDetalleUsuario' value='$idUsuario'>";
        echo "<input type='submit' value='Volver a detalles de usuario'>";
        echo "</form>";
    } else if (!$insertado) {
        echo "<p>Los datos suministrados no corresponden con ninguno de nuestros registros</p>";
        echo '<button class="volverAtras" onclick="window.location.href=\'usuarios.php\'">Volver a Listado de Usuarios</button>';
    } else {
        echo "<p>Error al crear el seguimiento</p>";
    }
} else {
    $mostrarBotonVolverAListadoUsuarios = false;
    echo "<ul>";
    foreach ($errores as $error) {
        echo "<li>" . $error . "</li>";
        if ($error === "Error en los datos del empleado"
            || $error === "El empleado para ese seguimiento no es válido"
            || $error === "Datos de usuario no válidos") {
            $mostrarBotonVolverAListadoUsuarios = true;
        }
    }
    echo "</ul>";
    if (!$mostrarBotonVolverAListadoUsuarios) {
        echo "<form action='detalleusuario.php' method='post'>";
        echo "<input type='hidden' name='idDetalleUsuario' value='$idUsuario'>";
        echo "<input type='submit' value='Volver a detalles de usuario'>";
        echo "</form>";
    } else {
        echo '<button class="volverAtras" onclick="window.location.href=\'usuarios.php\'">Volver a Listado de Usuarios</button>';
    }
}
$pdo = null;
?>

</body>
</html>
