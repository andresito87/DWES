<?php
require 'vendor/autoload.php';

use GuzzleHttp\Client;

if (isset($_POST['idTaller']) && isset($_POST['enviar']) && $_POST['enviar'] == 'Enviar') {
    $client = new Client(['http_errors' => false]);
    $idTaller = $_POST['idTaller'];
    $response = $client->request('DELETE', 'http://127.0.0.1:8000/api/talleres/' . $idTaller);
    $status = $response->getStatusCode();
    echo $status;

    if ($status == 404) {
        echo $response->getBody()->getContents();
    }

} else {
    echo 'No se ha enviado el id del taller. Vuelva a intentarlo';
}

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
        <input type="submit" name="enviar" value="Enviar" />
    </form>
</body>

</html>