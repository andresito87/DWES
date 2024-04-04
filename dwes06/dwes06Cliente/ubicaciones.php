<?php
require 'vendor/autoload.php';

use GuzzleHttp\Client;

$client = new Client(['base_uri' => 'http://127.0.0.1:8000/', 'http_errors' => 'false']);

// Obtener todas las ubicaciones
$response = $client->request('GET', 'api/ubicaciones');

echo $response->getStatusCode() . '<BR>'; // 200

echo $response->getHeaderLine('content-type') . '<BR>'; // 'application/json; charset=utf8'

$ubicaciones = json_decode($response->getBody(), true);
?>

<table border='1'>
    <thead>
        <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Latitud</th>
            <th>Longitud</th>
            <!-- Agrega más columnas según los datos que tengas -->
        </tr>
    </thead>
    <tbody>
        <?php foreach ($ubicaciones as $ubicacion) { ?>
            <tr>
                <td>
                    <?= $ubicacion['id'] ?>
                </td>
                <td>
                    <?= $ubicacion['nombre'] ?>
                </td>
                <td>
                    <?= $ubicacion['descripcion'] ?>
                </td>
                <td>
                    <?php $dias = explode(',', $ubicacion['dias']);
                    echo implode(' / ', $dias) ?>
                </td>
                <!-- Agrega más celdas según los datos que tengas -->
            </tr>
        <?php } ?>
    </tbody>
</table>

<?php

// Enviamos una solicitud asíncrona
$request = new \GuzzleHttp\Psr7\Request('GET', 'http://127.0.0.1:8000/api/ubicaciones');
$promise = $client->sendAsync($request)->then(function ($response) {
    echo '<BR>' . 'El resultado de la petición asíncrona fue ' . '<BR>';

    $ubicacionesAsincronas = json_decode($response->getBody(), true);

    if (is_array($ubicacionesAsincronas)) { // Verifica si es un array
        ?>
        <table border='1'>
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Latitud</th>
                    <th>Longitud</th>
                    <!-- Agrega más columnas según los datos que tengas -->
                </tr>
            </thead>
            <tbody>
                <?php foreach ($ubicacionesAsincronas as $ubicacion) { ?>
                    <tr>
                        <td>
                            <?= $ubicacion['id'] ?>
                        </td>
                        <td>
                            <?= $ubicacion['nombre'] ?>
                        </td>
                        <td>
                            <?= $ubicacion['descripcion'] ?>
                        </td>
                        <td>
                            <?php $dias = explode(',', $ubicacion['dias']);
                            echo implode(' / ', $dias) ?>
                        </td>
                        <!-- Agrega más celdas según los datos que tengas -->
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <?php
    }
});
$promise->wait();
?>