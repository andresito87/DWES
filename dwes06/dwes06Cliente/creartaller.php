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

if ($status == 404) {
    echo '<BR><h2>La ubicación no existe</h2>';
} else if ($status == 422) {
    echo '<BR><h2>Solicitud no procesable</h2>';
    echo '<BR><h3>Errores Encontrados:</h3> <BR>';
    // Obtener el cuerpo de la respuesta como una cadena JSON
    $body = $response->getBody()->getContents();

    // Decodificar la cadena JSON a un array asociativo
    $errores = json_decode($body, true);

    // Recorremos el array de errores y mostramos el mensaje
    foreach ($errores["errores"] as $campo => $mensajes) {
        foreach ($mensajes as $mensaje) {
            echo "$mensaje<br>";
        }
    }
} else if ($status == 200) {
    echo '<h2>Solicitud procesada correctamente.</h2><BR><h3>Taller con nombre "' . $datosRecibidos['nombre'] . '" almacenado exitosamente.</h3>';
} else {
    echo '<BR><h2>Situación desconocida. Código de estado ' . $status . '<BR>';
}
