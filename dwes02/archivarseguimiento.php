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

if ($_POST['idSeguimiento'] && isset($_POST['archivar']) && $_POST['archivar'] == 'archivar') {
    $idSeguimiento = filter_input(INPUT_POST, 'idSeguimiento', FILTER_VALIDATE_INT);

    $pdo = connect();
    $archivar = archivarSeguimiento($pdo, $idSeguimiento);
    if ($archivar) {
        echo '<h2>Seguimiento archivado correctamente</h2>';
    } else {
        echo '<h2>Error al archivar el seguimiento</h2>';
    }
} else {
    ?>

    <form action="archivarseguimiento.php" method="post">
        <label for="archivar">Marca la siguiente casilla para confirmar la operación de archivado</label>
        <input type="checkbox" name="archivar" value="archivar">
        </label>
        <input type="hidden" name="idSeguimiento" value="<?php echo $_POST['idSeguimiento'] ?>">
        <br>
        <input type="submit" value="ARCHIVAR">
    </form>

    <?php
}
?>

</body>
</html>
