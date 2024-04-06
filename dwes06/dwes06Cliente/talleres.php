<?php
require 'vendor/autoload.php';

use GuzzleHttp\Client;

if (isset($_GET['ubicacion']) && $_GET['ubicacion'] != '') {
    $idUbicacion = $_GET['ubicacion'];
    $cliente = new Client(['http_errors' => false]);
    $response = $cliente->request('GET', 'http://127.0.0.1:8000/api/ubicaciones/' . $idUbicacion . '/talleres');
    $status = $response->getStatusCode(); //Código de estado HTTP retornado en la petición HTTP
    ?>
    <h3>Estado retornado por la petición:
        <?= $status ?>
    </h3>
    <?php
    if ($status == 404) {
        $body = json_decode($response->getBody(), true);
        echo '<h2>ERROR: ' . $body['error'] . '</h2>';
    } else if ($status == 200) {
        $talleres = json_decode($response->getBody(), true);
        if (! empty($talleres)) {
            ?>
                <h2>Listado de talleres:</h2>
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
                            <th>Día</th>
                            <th>Hora de Inicio</th>
                            <th>Hora de Fin</th>
                            <th>Cupo máximo</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($talleres as $taller) { ?>
                            <tr>
                                <td>
                                <?= $taller['id'] ?>
                                </td>
                                <td>
                                <?= $taller['nombre'] ?>
                                </td>
                                <td>
                                <?= $taller['descripcion'] ?>
                                </td>
                                <td>
                                <?= $taller['dia_semana'] ?>
                                </td>
                                <td>
                                <?= $taller['hora_inicio'] ?>
                                </td>
                                <td>
                                <?= $taller['hora_fin'] ?>
                                </td>
                                <td>
                                <?= $taller['cupo_maximo'] ?>
                                </td>
                            </tr>
                    <?php } ?>
                    </tbody>
                </table>
            <?php
        } else {
            ?>
                <p>No hay talleres en esta ubicación</p>
            <?php
        }
    }
} else {
    ?>
    <h2>No se ha indicado la ubicación de la que obtener el listado de talleres.</h2>
    <p>Recuerda poner http://localhost/dwes06/dwes06Cliente/talleres.php?ubicacion=...</p>
    <?php
}