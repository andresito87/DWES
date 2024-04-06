<?php
require 'vendor/autoload.php';

use GuzzleHttp\Client;

if (! isset($_POST) || empty($_POST)) {
    echo '<h1>No se han enviado datos através del formulario</h1>';
    return;
}
// Creo el array con los datos recibidos, el usar la convención de CamelCase para escribir el nombre de los campos me obliga a adaptarlo a snake_case para almacenarlo en la base de datos
$datosRecibidos = ['nombre' => $_POST['nombre'], 'descripcion' => $_POST['descripcion'], 'dia_semana' => $_POST['diaSemana'], 'hora_inicio' => $_POST['horaInicio'], 'hora_fin' => $_POST['horaFin'], 'cupo_maximo' => $_POST['cupoMaximo'], 'idUbicacion' => $_POST['idUbicacion']];

$client = new Client(['http_errors' => false]);
$response = $client->request('POST', 'http://127.0.0.1:8000/api/ubicaciones/' . $datosRecibidos['idUbicacion'] . '/creartaller', ['form_params' => $datosRecibidos]);
$status = $response->getStatusCode(); //Código de estado HTTP
// Obtener el cuerpo de la respuesta como una cadena JSON
$body = $response->getBody()->getContents();

// Decodificar la cadena JSON a un array asociativo
$datosDevueltos = json_decode($body, true);

if ($status == 404) {
    echo '<h2>' . $datosDevueltos['error'] . '</h2>';
} else if ($status == 422) {
    echo '<h2>Los datos recibidos tienen errores:</h2>';

    // Recorremos el array de errores y mostramos el mensaje
    echo '<ul>';
    foreach ($datosDevueltos["errores"] as $campo => $mensajes) {
        echo '<li>Errores en el dato <strong>' . $campo . '</strong>:</li>';
        echo '<ul>';
        foreach ($mensajes as $mensaje) {
            echo '<li>' . $mensaje . '</li><BR>';
        }
        echo '</ul>';
    }
    echo '</ul>';
} else if ($status == 200) {
    echo '<h2>Taller creado.</h2>';

    // Muestro los datos del taller creado retornados desde el servidor
    if (isset($datosDevueltos['datos'])) {
        $taller = $datosDevueltos['datos'];

        // Mostrar los datos del taller en una tabla HTML
        echo '<style>
        table {
            border-collapse: collapse;
            width: 100%;
            text-align: center;
        }
        th, td {
            padding: 8px;
            border: 1px solid #dddddd;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>';
        echo '<table border="1">';
        echo '<tr><th>Nombre</th><th>Descripción</th><th>Día Semana</th><th>Hora Inicio</th><th>Hora Fin</th><th>Cupo Máximo</th><th>Ubicación ID</th></tr>';
        echo '<tr>';
        echo '<td>' . $taller['nombre'] . '</td>';
        echo '<td>' . $taller['descripcion'] . '</td>';
        echo '<td>' . $taller['dia_semana'] . '</td>';
        echo '<td>' . $taller['hora_inicio'] . '</td>';
        echo '<td>' . $taller['hora_fin'] . '</td>';
        echo '<td>' . $taller['cupo_maximo'] . '</td>';
        echo '<td>' . $taller['ubicacion_id'] . '</td>';
        echo '</tr>';
        echo '</table>';
    }
} else {
    echo '<h2>Situación desconocida. Código de estado ' . $status;
}
