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
require 'src/conn.php';
require 'src/dbfuncs.php';

if (isset($_POST['idSeguimiento']) && isset($_POST['idUsuario'])) {
    $pdo = connect();
    $idUsuario = filter_input(INPUT_POST, 'idUsuario', FILTER_VALIDATE_INT);
    $idSeguimiento = filter_input(INPUT_POST, 'idSeguimiento', FILTER_VALIDATE_INT);
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
        //TODO:Con tantas comprobaciones, el código se hace muy largo y difícil de leer
        $informe = filter_input(INPUT_POST, 'informe', FILTER_SANITIZE_STRING);
        $informe = trim($informe);
        if (strlen($informe) >= 5) {
            $informe = strip_tags($informe, '<B><STRONG><U><EM>');
        } else {
            echo "<form action='seguimientocontactado.php' method='post'>";
            echo "<input type='hidden' name='idUsuario' value='$idUsuario'>";
            echo "<input type='hidden' name='idSeguimiento' value='$idSeguimiento'>";
            echo "<input type='submit' value='Volver a detalles de usuario'>";
            echo "</form>";
            die("<p>El informe debe tener al menos 5 caracteres</p>");
        }
        
        if ($idSeguimiento < 1 || $idUsuario < 1) {
            die("<p>Error en los datos suministrados</p>");
        }

        $seguimiento = actualizarInforme($pdo, $idSeguimiento, $informe);
        if ($seguimiento === 1) {
            echo "<h2>Seguimiento actualizado correctamente</h2>";
        } else if ($seguimiento === 0) {
            echo "<h2>Los datos suministrados no corresponden con ninguno de nuestros registros</h2>";
        } else {
            echo "<h2>Error al actualizar el seguimiento</h2>";
        }

        echo "<form action='detalleusuario.php' method='post'>";
        echo "<input type='hidden' name='idDetalleUsuario' value='$idUsuario'>";
        echo "<input type='submit' value='Volver a detalles de usuario'>";
        echo "</form>";

    }
} else {
    echo "<p>Error en los datos suministrados</p>";
}
?>
</body>
</html>


