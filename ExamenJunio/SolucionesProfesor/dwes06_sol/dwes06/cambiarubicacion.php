<?php

require 'vendor/autoload.php';

$taller = filter_input(INPUT_POST, 'idtaller', FILTER_VALIDATE_INT);
$datos_json['nueva_ubicacion'] = filter_input(INPUT_POST, 'idnuevaubicacion');
$status=null;
$data=null;
if ($taller !== null && $taller !== false) {
    $client = new GuzzleHttp\Client(['base_uri' => 'http://localhost:8080/api/', 'http_errors' => false]);
    $response = $client->patch('talleres/' . $taller.'/cambiarubicacion',['json'=>$datos_json]);
    $json = $response->getBody()->getContents();
    $status = $response->getStatusCode();
    $data = json_decode($json, true);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Talleres - Cambiar ubicacion</title>
</head>

<body>
    <?php if ($status === 200 && $data !== null) : ?>
        <H2>Taller cambiado de ubicación</H2>
        Resultado operación:<?= $data['resultado']; ?>
    <?php elseif ($status === 404 || $status===422 || $status===409 && $data !== null) : ?>
        <h2>ERROR al eliminar el taller: <?= $data['error'] ?>        
    <?php elseif ($taller === null || $taller === false) : ?>
            <?php if ($taller === false) : ?>
                <h2>Debe indicar un entero como id de taller.</h2>
            <?php endif; ?>
            <form action="cambiarubicacion.php" method="POST">
                <label for="idtaller">ID del taller:</label><br>
                <input type="text" id="idtaller" name="idtaller"><br><br>
                <label for="idnuevaubicacion">ID de la nueva ubicación:</label><br>
                <input type="text" id="idnuevaubicacion" name="idnuevaubicacion"><br><br>
                <input type="submit" value="Cambiar ubicacion!">
            </form>
    <?php endif; ?>
</body>

</html>