<!DOCTYPE html>
<html lang="es" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="styles/estilosSeguimientoContactado.css">
    <title>Archivar Seguimiento</title>
</head>
<body>

<?php
require 'src/conn.php';
require 'src/dbfuncs.php';

$idUsuario = filter_input(INPUT_POST, 'idUsuario', FILTER_VALIDATE_INT);
$idSeguimiento = filter_input(INPUT_POST, 'idSeguimiento', FILTER_VALIDATE_INT);
if (is_int($idUsuario) && is_int($idSeguimiento)) {
    if (isset($_POST['archivar']) && $_POST['archivar'] == 'archivar') {
        $pdo = connect();
        $archivar = archivarSeguimiento($pdo, $idSeguimiento);
        if ($archivar === -1) {
            echo '<h2>Los datos suministrados no corresponden con ninguno de nuestros registros</h2>';
        } else if ($archivar) {
            echo '<h2>Seguimiento archivado correctamente</h2>';
        } else {
            echo '<h2>Error al archivar el seguimiento</h2>';
        }
        echo "<form action='detalleusuario.php' method='post'>";
        echo "<input type='hidden' name='idDetalleUsuario' value='$idUsuario'>";
        echo "<input type='submit' value='Volver a detalles de usuario'>";
        echo "</form>";
    } else {
        ?>

        <form action="archivarseguimiento.php" method="post">
            <label for="archivar">Marca la siguiente casilla para confirmar la operación de archivado</label>
            <input type="checkbox" id="archivar" name="archivar" value="archivar">
            <input type="hidden" name="idUsuario" value="<?php echo $_POST['idUsuario'] ?>">
            <input type="hidden" name="idSeguimiento" value="<?php echo $_POST['idSeguimiento'] ?>">
            <br>
            <input type="submit" value="ARCHIVAR">
        </form>

        <?php
    }
} else {
    echo "<p>Error en los datos suministrados</p>";
}
?>

</body>
</html>
