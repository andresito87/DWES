<?php

require 'vendor/autoload.php';

$taller = filter_input(INPUT_POST, 'idtaller', FILTER_VALIDATE_INT);
$status=null;
$data=null;
if ($taller !== null && $taller !== false) {
    $client = new GuzzleHttp\Client(['base_uri' => 'http://localhost:8080/api/', 'http_errors' => false]);
    $response = $client->request('DELETE', 'talleres/' . $taller);
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
    <title>Talleres - Borrar Taller</title>
</head>

<body>
    <?php if ($status === 200 && $data !== null) : ?>
        <H2>Taller eliminado</H2>
        Resultado operación:<?= $data['resultado']; ?>
    <?php elseif ($status === 404 && $data !== null) : ?>
        <h2>ERROR al elimnar el taller: <?= $data['resultado'] ?>
    <?php elseif ($taller === null || $taller === false) : ?>
            <?php if ($taller === false) : ?>
                <h2>Debe indicar un entero como id de taller.</h2>
            <?php endif; ?>
            <form action="borrartaller.php" method="POST">
                <label for="idtaller">ID del taller:</label><br>
                <input type="text" id="idtaller" name="idtaller"><br><br>
                <input type="submit" value="Eliminar!">
            </form>
    <?php endif; ?>
</body>

</html>