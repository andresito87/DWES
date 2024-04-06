<?php
require 'vendor/autoload.php';

use GuzzleHttp\Client;

if (isset($_POST['cambiar']) && $_POST['cambiar'] == 'Cambiar Ubicacion') {
    if (isset($_POST['idTaller']) && ! empty(trim($_POST['idTaller']))) {
        $client = new Client(['http_errors' => false]);
        $idTaller = $_POST['idTaller'];
        $response = $client->patch('http://127.0.0.1:8000/api/talleres/' . $idTaller . '/cambiarubicacion', [
            'json' => ['nueva_ubicacion' => $_POST['nuevaUbicacion']]
        ]);
        $status = $response->getStatusCode();
        $body = $response->getBody()->getContents();
        $mensaje = json_decode($body, true);
        if ($status == 404 || $status == 409 || $status == 422) {
            if (isset($mensaje['error'])) {
                echo '<h2>ERROR al cambiar de ubicación el taller: ' . $mensaje['error'] . '</h2>';
            }
        } else if ($status == 200) {
            echo '<h2>Ubicación del taller modificada correctamente.</h2>';
            echo 'Resultado de la operación: <strong>' . $mensaje['resultado'] . '</strong>';
            echo '<br />';
            echo 'Datos del taller modificado: ';
            echo '<pre>';
            print_r($mensaje['datos']);
            echo '</pre>';
        }
    } else {
        echo '<h2>No se han enviado el id del taller. Vuelva a intentarlo.</h2>';
    }

} else {
    ?>
    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Formulario de eliminación de taller</title>
        <link rel="stylesheet" href="./styles/estilos.css">
    </head>

    <body>
        <h1>Introduce el id del taller y el id de su nueva ubicación:</h1>
        <form action="cambiarubicacion.php" method="post">
            <label for="idTaller">Id Taller:</label>
            <input type="text" name="idTaller" />
            <BR />
            <label for="eliminar">Id Ubicacion:</label>
            <input type="text" name="nuevaUbicacion" />
            <BR />
            <input type="submit" name="cambiar" value="Cambiar Ubicacion" />
        </form>
    </body>

    </html>
    <?php
}