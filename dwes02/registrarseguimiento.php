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
require 'src/conn.php';
require 'src/dbfuncs.php';

$errores = [];
if (isset($_POST['idUsuario'])) {
    $idUsuario = filter_input(INPUT_POST, 'idUsuario', FILTER_VALIDATE_INT);
} else {
    $errores[] = "Datos de usuario no válidos";
}
if (isset($_POST['fechaSeguimiento'])) {
    $pdo = connect();
    $fechaSeguimiento = filter_input(INPUT_POST, 'fechaSeguimiento', FILTER_SANITIZE_STRING);
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
if (isset($_POST['horaSeguimiento'])) {
    $horaSeguimiento = filter_input(INPUT_POST, 'horaSeguimiento', FILTER_SANITIZE_STRING);
    if (!preg_match("/^\d{2}:\d{2}$/", $horaSeguimiento)) {
        $errores[] = "La hora de seguimiento no es válida";
    }
} else {
    $errores[] = "La hora de seguimiento no es válida";
}

if (isset($_POST['empleadoSeguimiento'])) {
    $empleadoSeguimiento = filter_input(INPUT_POST, 'empleadoSeguimiento', FILTER_SANITIZE_STRING);
    $empleadoSeguimiento = filter_input(INPUT_POST, 'empleadoSeguimiento', FILTER_VALIDATE_INT);
    $empleados = listadoCoordinadoresOTrabSociales($pdo);
    if (!array_key_exists($empleadoSeguimiento, $empleados)) {
        $errores[] = "El empleado de seguimiento no es válido";
    }
} else {
    $errores[] = "El empleado de seguimiento no es válido";
}
if (isset($_POST['medioSeguimiento'])) {
    $medioSeguimiento = filter_input(INPUT_POST, 'medioSeguimiento', FILTER_SANITIZE_STRING);
    $mediosValidos = ['TLF', 'EMAIL', 'PRESENCIAL', 'VIDEOCONF', 'OTRO'];
    if (!in_array($medioSeguimiento, $mediosValidos)) {
        $errores[] = "El medio de seguimiento no es válido";
    }
    if ($medioSeguimiento === 'OTRO') {
        if (isset($_POST['otroMedioSeguimiento']) && trim($_POST['otroMedioSeguimiento']) !== '') {
            $otroMedioSeguimiento = filter_input(INPUT_POST, 'otroMedioSeguimiento', FILTER_SANITIZE_STRING);
        } else {
            $errores[] = "El otro medio de seguimiento no es válido";
        }
    }
} else {
    $errores[] = "El medio de seguimiento no es válido";
}

if ($errores === []) {
    $fechahora = $fechaSeguimiento->format('Y-m-d') . " " . $horaSeguimiento;
    $contactado = false;
    $informe = null;
    $empleadosId = $empleadoSeguimiento;
    $usuariosId = $_POST['idUsuario'];
    $insertado = insertarSeguimientos($pdo, $fechahora, $medioSeguimiento, $otroMedioSeguimiento ?? null, $contactado, $informe, $empleadosId, $usuariosId);
    if ($insertado) {
        echo "Se ha insertado el seguimiento correctamente";
    }
}
if ($errores !== []) {
    echo "<ul>";
    foreach ($errores as $error) {
        echo "<li>" . $error . "</li>";
    }
    echo "</ul>";
}
echo "<form action='detalleusuario.php' method='post'>";
echo "<input type='hidden' name='idDetalleUsuario' value='$idUsuario'>";
echo "<input type='submit' value='Volver a detalles de usuario'>";
echo "</form>";
?>

</body>
</html>
