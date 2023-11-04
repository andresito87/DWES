<?php
require 'src/conn.php';
require 'src/dbfuncs.php';

$pdo = connect();
$errores = [];
if (isset($_POST['fechaSeguimiento'])) {
    $fechaSeguimiento = filter_input(INPUT_POST, 'fechaSeguimiento', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $fechaSeguimiento = DateTime::createFromFormat('d/m/Y', $fechaSeguimiento);
    $dia = $fechaSeguimiento->format('d');
    $mes = $fechaSeguimiento->format('m');
    $anio = $fechaSeguimiento->format('Y');
    if (!$fechaSeguimiento
        || !preg_match("/^\d{2}\/\d{2}\/\d{4}$/", $fechaSeguimiento->format('d/m/Y'))
        || !checkdate($mes, $dia, $anio)) {
        $errores[] = "La fecha de seguimiento no es válida";
    }
}
if (isset($_POST['horaSeguimiento'])) {
    $horaSeguimiento = filter_input(INPUT_POST, 'horaSeguimiento', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    if (!preg_match("/^\d{2}:\d{2}$/", $horaSeguimiento)) {
        $errores[] = "La hora de seguimiento no es válida";
    }
}

if (isset($_POST['empleadoSeguimiento'])) {
    $empleadoSeguimiento = filter_input(INPUT_POST, 'empleadoSeguimiento', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $empleadoSeguimiento = filter_input(INPUT_POST, 'empleadoSeguimiento', FILTER_VALIDATE_INT);
    $empleados = listadoCoordinadoresOTrabSociales($pdo);
    if (!array_key_exists($empleadoSeguimiento, $empleados)) {
        $errores[] = "El empleado de seguimiento no es válido";
    }
}
if (isset($_POST['medioSeguimiento'])) {
    $medioSeguimiento = filter_input(INPUT_POST, 'medioSeguimiento', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $mediosValidos = ['TLF', 'EMAIL', 'PRESENCIAL', 'VIDEOCONF', 'OTRO'];
    if (!in_array($medioSeguimiento, $mediosValidos)) {
        $errores[] = "El medio de seguimiento no es válido";
    }
    if ($medioSeguimiento === 'OTRO') {
        if (isset($_POST['otroMedioSeguimiento']) && trim($_POST['otroMedioSeguimiento']) !== '') {
            $otroMedioSeguimiento = filter_input(INPUT_POST, 'otroMedioSeguimiento', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        } else {
            $errores[] = "El otro medio de seguimiento no es válido";
        }
    }
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
    } else {
        $errores[] = "Error al insertar el seguimiento";
    }
} else {
    echo "<ul>";
    foreach ($errores as $error) {
        echo "<li>" . $error . "</li>";
    }
    echo "</ul>";
}
?>