<?php
require_once 'src/conn.php';
require_once 'src/dbfuncs.php';
require 'session_control.php';
require_once 'src/userauth.php';
require_once 'extra/header.php';

$es_usuario_autorizado = false;
if (verificacion_rol_de_sesion('coord') || verificacion_rol_de_sesion('trasoc')) {
    $es_usuario_autorizado = true;
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="styles/estilosSeguimientoContactado.css">
    <title>Informe de seguimiento</title>
</head>

<body>
    <?php
    if (!$es_usuario_autorizado) {
        die("<h1>No tienes permisos para acceder a esta página</h1>");
    }
    $idUsuario = filter_input(INPUT_POST, 'idUsuario', FILTER_VALIDATE_INT);
    $idSeguimiento = filter_input(INPUT_POST, 'idSeguimiento', FILTER_VALIDATE_INT);
    if (is_int($idUsuario) && is_int($idSeguimiento) && $idUsuario > 0 && $idSeguimiento > 0) {
        $pdo = connect();
        if (!isset($_POST['informe'])) {
            echo '<h1>Introduzca el informe de seguimiento:</h1>
           <form action="seguimientocontactado.php" method="post">
            <textarea name="informe" id="informe" cols="60" rows="10"></textarea>
            <input type="hidden" name="idUsuario" value="' . $idUsuario . '">
            <input type="hidden" name="idSeguimiento" value="' . $idSeguimiento . '">
            <br>
            <input type="submit" value="Confirmar contacto y añadir informe" name="enviarInforme">
          </form>';
        } else {
            //Filtro con el filtro FILTER_SANITIZE_SPECIAL_CHARS para evitar que se introduzcan caracteres especiales pero
            //permitiendo que se introduzcan etiquetas html
            $informe = filter_input(INPUT_POST, 'informe', FILTER_SANITIZE_SPECIAL_CHARS);
            if (strlen($informe) >= 5) {
                //Decodifico las etiquetas html para que la función strip_tags las pueda eliminar si es necesario
                $informe = htmlspecialchars_decode($informe);
                //Elimino todas las etiquetas html excepto <p><i><b><strong><u><em>
                $informe = strip_tags($informe, '<p><i><b><strong><u><em>');
                //Decodifico las etiquetas html para que se muestre su valor literal
                //$informe = htmlspecialchars_decode($informe);
            } else {
                echo "<h2>El informe debe tener al menos 5 caracteres</h2>";
                echo "<form action='seguimientocontactado.php' method='post'>";
                echo "<input type='hidden' name='idUsuario' value='$idUsuario'>";
                echo "<input type='hidden' name='idSeguimiento' value='$idSeguimiento'>";
                echo "<input type='submit' value='Volver Atrás'>";
                echo "</form>";
                die();
            }

            //Comprobamos que el usuario que está intentando actualizar el seguimiento es el mismo que lo creó
            if (verificacion_empleado_asignado_a_seguimiento($pdo, $idSeguimiento)) {
                $seguimiento = actualizarInforme($pdo, $idSeguimiento, $informe);
                if ($seguimiento === 1) {
                    echo "<h2>Informe de seguimiento actualizado correctamente</h2>";
                } else if ($seguimiento === 0) {
                    echo "<h2>Los datos suministrados no corresponden con ninguno de nuestros registros</h2>";
                } else {
                    echo "<h2>Error al actualizar el seguimiento</h2>";
                }
                echo "<form action='detalleusuario.php' method='post'>";
                echo "<input type='hidden' name='idDetalleUsuario' value='$idUsuario'>";
                echo "<input type='submit' value='Volver a detalles de usuario'>";
                echo "</form>";
            } else {
                echo "<h2>ERROR: solo puede modificar el informe el autor original.</h2>";
            }
        }
    } else {
        echo "<h2>Error en los datos suministrados</h2>";
    }
    ?>

</body>

</html>