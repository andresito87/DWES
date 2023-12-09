<?php
if (isset($_COOKIE['numeros'])) {
    $datos = @unserialize($_COOKIE['numeros']);
    if ($datos === false) {
        $datos = [];
    }
    $datosRecibidos = $datos;
} else {
    $datos = [];
}

if (count($datos) > 0 && count($datos) < 10)
    $datos[] = random_int(1, 100);
else {
    $datos = [random_int(1, 100)];
}
$datosEnviados = $datos;
setcookie('numeros', serialize($datos));
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <H1>El contenido de la cookie "numeros" RECIBIDA del navegador es...</H1>
    <?php
    if (!isset($datosRecibidos) || !$datosRecibidos) {
        echo '<H2> No hay números almacenados en la cookie del navegador o no existe la cookie "numeros" todavía. </H2>';
    } else {
        echo '<UL>';
        foreach ($datosRecibidos as $numeroRecibido) {
            echo "<LI>{$numeroRecibido}</LI>";
        }
        echo '</UL>';
    }
    ?>

    <H1>El contenido de la cookie "numeros" ENVIADA del navegador es...</H1>
    <?php
    if (!$datosEnviados) {
        echo '<H2> No hay números almacenados en la cookie del navegador </H2>';
    } else {
        echo '<UL>';
        foreach ($datosEnviados as $numeroEnviado) {
            echo "<LI>{$numeroEnviado}</LI>";
        }
        echo '</UL>';
    }
    ?>
</body>

</html>