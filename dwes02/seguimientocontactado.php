<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Informe de seguimiento</title>
</head>
<body>
<?php
require 'src/conn.php';
require 'src/dbfuncs.php';

$pdo = connect();
if (isset($_POST['idSeguimiento']) && !isset($_POST['informe'])) {
    $id = filter_input(INPUT_POST, 'idSeguimiento', FILTER_VALIDATE_INT);

    echo '<h1>Introduzca el informe de seguimiento:</h1>
           <form action="seguimientocontactado.php" method="post">
            <textarea name="informe" id="informe" cols="30" rows="10"></textarea>
            <input type="hidden" name="idSeguimiento" value="' . $id . '">
            <input type="submit" value="Enviar informe" name="enviarInforme">
          </form>';
} else if (isset($_POST['informe']) && $_POST['informe'] !== '') {
    //TODO:Con tantas comprobaciones, el código se hace muy largo y difícil de leer
    $informe = filter_input(INPUT_POST, 'informe', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $informe=trim($informe);
    if(strlen($informe)>=5) {
        $informe = strip_tags($informe, '<B><STRONG><U><EM>');
    }else{
        echo "<p>El informe debe tener al menos 5 caracteres</p>";
        die();
    }
    $idSeguimiento = filter_input(INPUT_POST, 'idSeguimiento', FILTER_VALIDATE_INT);
    if (!$idSeguimiento || $idSeguimiento < 1) {
        echo "<p>Error en los datos suministrados</p>";
        die();
    }
    
    try {
        $seguimiento = actualizarInforme($pdo, $idSeguimiento, $informe);
    } catch (PDOException $e) {
        $error = $e->getMessage();
        echo "Error:. $error";
        die();
    }
    echo "<p>Se ha actualizado el informe</p>";
} else {
    echo "<p>Error en los datos suministrados</p>";
}
?>
</body>
</html>


