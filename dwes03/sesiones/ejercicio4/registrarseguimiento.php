<?php
require 'src/conn.php';
require 'src/dbfuncs.php';
require 'session_control.php';
require_once 'src/userauth.php';
require_once 'extra/header.php';

$errores = [];
$es_usuario_autorizado = false;

if (verificacion_rol_de_sesion('coord') || verificacion_rol_de_sesion('trasoc')) {
    $es_usuario_autorizado = true;
    $es_coordinador = false;
    if (verificacion_rol_de_sesion('coord')) {
        $es_coordinador = true;
    }
    // $idUsuario = filter_input(INPUT_POST, 'idUsuario', FILTER_VALIDATE_INT);
    $idUsuario = $_SESSION['auth']['id'];
    if ($idUsuario === false || !is_int($idUsuario) || trim($idUsuario) === '' || $idUsuario <= 0) {
        $errores[] = "Datos de usuario no válidos";
    }

    $fechaSeguimiento = filter_input(INPUT_POST, 'fechaSeguimiento', FILTER_SANITIZE_SPECIAL_CHARS);
    if ($fechaSeguimiento !== false && $fechaSeguimiento !== null && trim($fechaSeguimiento) !== '') {
        if (preg_match("/^\d{2}\/\d{2}\/\d{4}$/", $fechaSeguimiento)) {
            $fechaSeguimiento = explode('/', $fechaSeguimiento);
            $dia = $fechaSeguimiento[0];
            $mes = $fechaSeguimiento[1];
            $anio = $fechaSeguimiento[2];
            if (checkdate($mes, $dia, $anio)) {
                try {
                    $fechaSeguimiento = new DateTime($anio . '-' . $mes . '-' . $dia);
                } catch (Exception $e) {
                    $errores[] = "La fecha de seguimiento no es válida";
                }
            } else {
                $errores[] = "La fecha de seguimiento no es válida";
            }
        } else {
            $errores[] = "La fecha de seguimiento no es válida";
        }
    } else {
        $errores[] = "La fecha de seguimiento no es válida";
    }

    $horaSeguimiento = filter_input(INPUT_POST, 'horaSeguimiento', FILTER_SANITIZE_SPECIAL_CHARS);
    if ($horaSeguimiento !== false && $horaSeguimiento !== null && trim($horaSeguimiento) !== '') {
        if (!preg_match("/^\d{2}:\d{2}$/", $horaSeguimiento) || $horaSeguimiento > '23:59' || $horaSeguimiento < '00:00') {
            $errores[] = "La hora de seguimiento no es válida";
        }
    } else {
        $errores[] = "La hora de seguimiento no es válida";
    }

    $medioSeguimiento = filter_input(INPUT_POST, 'medioSeguimiento', FILTER_SANITIZE_SPECIAL_CHARS);
    if ($medioSeguimiento !== false && $medioSeguimiento !== null && trim($medioSeguimiento) !== '') {
        $mediosValidos = ['TLF', 'EMAIL', 'PRESENCIAL', 'VIDEOCONF', 'OTRO'];
        if (!in_array($medioSeguimiento, $mediosValidos)) {
            $errores[] = "El medio de seguimiento no es válido";
        }
        if ($medioSeguimiento === 'OTRO') {
            $otroMedioSeguimiento = filter_input(INPUT_POST, 'otroMedioSeguimiento', FILTER_SANITIZE_SPECIAL_CHARS);
            if (!is_string($otroMedioSeguimiento) || trim($otroMedioSeguimiento) === '') {
                $errores[] = "El otro medio de seguimiento no es válido";
            }
        }
    } else {
        $errores[] = "El medio de seguimiento no es válido";
    }

    $pdo = null;
    if ($es_coordinador) {
        $empleadoSeguimiento = filter_input(INPUT_POST, 'empleadoSeguimiento', FILTER_VALIDATE_INT);
    } else {
        $empleadoSeguimiento = $_SESSION['auth']['id'];
    }
    if ($empleadoSeguimiento !== false && $empleadoSeguimiento !== null && trim($empleadoSeguimiento) !== '') {
        $pdo = connect();
        $empleados = listadoCoordinadoresOTrabSociales($pdo);
        $empleadoEncontrado = false;
        foreach ($empleados as $empleado) {
            if ($empleado['id'] === $empleadoSeguimiento) {
                $empleadoEncontrado = true;
                break;
            }
        }
        if (is_array($empleados) && (empty($empleados)) || !$empleadoEncontrado) {
            $errores[] = "El empleado para ese seguimiento no es válido";
        }
    } else {
        $errores[] = "Error en los datos del empleado";
    }
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

    if (empty($errores) && $es_usuario_autorizado) {
        echo '<div id="contenido">';
        $fechahora = $fechaSeguimiento->format('Y-m-d') . " " . $horaSeguimiento;
        $contactado = false;
        $informe = null;
        $otroMedioSeguimiento ??= null;
        $usuariosId = $_POST['idUsuario'];
        $insertado = insertarSeguimientos($pdo, $fechahora, $medioSeguimiento, $otroMedioSeguimiento, $contactado, $informe, $empleadoSeguimiento, $usuariosId);
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
        echo "</div>";
    } else if ($es_usuario_autorizado) {
        echo '<div id="contenido">';
        $mostrarBotonVolverAListadoUsuarios = false;
        echo "<ul>";
        foreach ($errores as $error) {
            echo "<li>" . $error . "</li>";
            if (
                $error === "Error en los datos del empleado"
                || $error === "El empleado para ese seguimiento no es válido"
                || $error === "Datos de usuario no válidos"
            ) {
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
        echo "</div>";
    } else {
        echo "<h2>No tiene permisos para realizar esta acción</h2>";
    }
    $pdo = null;
    ?>

</body>

</html>