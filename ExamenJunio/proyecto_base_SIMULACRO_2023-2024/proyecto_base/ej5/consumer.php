<?php

//Puedes usar la siguiente constante como la URL para acceder a serve.php
define('SERVE_URL', 'http://' . $_SERVER['HTTP_HOST'] . str_replace(basename(__FILE__), 'serve.php', explode('?', $_SERVER['REQUEST_URI'])[0]));
//define('SERVE_URL','http://localhost:80/'.str_replace(basename(__FILE__),'serve.php',explode('?',$_SERVER['REQUEST_URI'])[0]));

require_once __DIR__ . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

use GuzzleHttp\Client;

$clienteHttp = new Client(['http_errors' => false]);

if (! empty($_POST['nombre'] ?? '') && ! empty($_POST['year'] ?? '') && is_numeric($_POST['year'] ?? false)) {
    if (! empty($_POST)) {

        $datos = new stdClass;
        $datos->nombre = $_POST['nombre'] ?? '';
        $datos->year = $_POST['year'] ?? '';
        $res = $clienteHttp->post(SERVE_URL,
            [
                'json' => $datos
            ]
        );
        $datosRecibidos = $res->getBody()->getContents();
        var_dump($datosRecibidos);
    }
}

$respuesta = $clienteHttp->get(SERVE_URL);
$datosVideojuegos = [];
if ($respuesta) {
    $datosRecibidos = $respuesta->getBody()->getContents();
    if ($datosRecibidos)
        $datosVideojuegos = json_decode($datosRecibidos, true)['videojuegos'];
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cliente Servicio Web con GuzzleHttp</title>
</head>

<body>

    <form action="" method="post">
        <H2>Introduce los datos del videojuego</H2>
        Nombre: <input type="text" name="nombre" id="nombre"><BR>
        Año: <input type="text" name="year" id="year"><BR>
        <input type="submit" value="Enviar!">
    </form>
    <H2>Lista de videojuegos actual</H2>
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Año</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($datosVideojuegos)) : ?>
                <tr>
                    <td colspan="2">No hay videojuegos con esas características</td>
                </tr>
            <?php else : ?>
                <?php foreach ($datosVideojuegos as $videojuego) : ?>
                    <tr>
                        <td><?= $videojuego[0] ?></td>
                        <td><?= $videojuego[1] ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>

</body>

</html>