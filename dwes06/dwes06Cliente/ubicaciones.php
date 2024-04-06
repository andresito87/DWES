<?php
require 'vendor/autoload.php';

use GuzzleHttp\Client;

$cliente = new Client(['http_errors' => false]);

// Obtener todas las ubicaciones
$response = $cliente->request('GET', 'http://127.0.0.1:8000/api/ubicaciones');

echo 'El código de estado de la petición síncrona fue ' . $response->getStatusCode() . '<BR>';
if ($response->getStatusCode() == 200) {
    $ubicaciones = json_decode($response->getBody(), true);
    ?>

    <style>
        table {
            border-collapse: collapse;
            width: 100%;
            text-align: center;
        }

        th,
        td {
            padding: 8px;
            border: 1px solid #dddddd;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>

    <table border='1'>
        <thead>
            <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Descripcion</th>
                <th>Días</th>
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
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <?php
}
// Enviamos una solicitud asíncrona
$request = new \GuzzleHttp\Psr7\Request('GET', 'http://127.0.0.1:8000/api/ubicaciones');
$promise = $cliente->sendAsync($request)->then(function ($response) {
    echo '<BR>' . 'El código de estado de la petición asíncrona fue ' . $response->getStatusCode() . '<BR>';
    if ($response->getStatusCode() == 200) {
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
    }
});

$promise->wait();
?>