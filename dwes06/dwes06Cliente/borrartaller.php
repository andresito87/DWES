<?php
require 'vendor/autoload.php';

use GuzzleHttp\Client;

if (isset($_POST['eliminar']) && $_POST['eliminar'] == 'Eliminar') {
    if (isset($_POST['idTaller']) && ! empty(trim($_POST['idTaller']))) {
        $client = new Client(['http_errors' => false]);
        $idTaller = $_POST['idTaller'];
        $response = $client->request('DELETE', 'http://127.0.0.1:8000/api/talleres/' . $idTaller);
        $status = $response->getStatusCode();
        $body = $response->getBody()->getContents();
        $mensaje = json_decode($body, true);
        if ($status == 404) {
            if (isset($mensaje['resultado'])) {
                echo '<h2>ERROR al eliminar el taller: ' . $mensaje['resultado'] . '</h2>';
            }
        } else if ($status == 200) {
            echo '<h2>Taller eliminado</h2>';
            echo 'Resultado de la operación: ' . $mensaje['resultado'];
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
    </head>

    <body>
        <h1>Introduce el id del taller a eliminar:</h1>
        <form action="borrartaller.php" method="post">
            <label for="idTaller">Id Taller:</label>
            <input type="text" name="idTaller" />
            <input type="submit" name="eliminar" value="Eliminar" />
        </form>
    </body>

    </html>
    <?php
}

