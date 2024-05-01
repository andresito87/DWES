<?php

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/conf.php';

/**
 * Conexión a un servicio remoto enviando autenticación
 * usando HTTP Basic
 */

//Creamos un cliente HTTP con Guzzle
$clienteHTTP = new GuzzleHttp\Client();

//Creamos un "bote" de cookies para almacenar las cookies
$jar = new \GuzzleHttp\Cookie\CookieJar;

// Establecemos los datos de autenticación (podrían estar en conf.php)
$usuario = 'ejemplo';
$password = 'ejemplo*';

$datosForm = [
    'user' => $usuario,
    'pwd' => $password
];

$url = SERVER_URI . 'auth.php';
try {
    // Enviar una solicitud POST al recurso enviando los datos de
    // autenticación como datos de formulario
    $response = $clienteHTTP->request('POST', $url,
        ['form_params' => $datosForm,
            'cookies' => $jar]
    );
    $body = $response->getBody();
    $resultado = json_decode($body->getContents());

} catch (GuzzleHttp\Exception\RequestException $e) {
    echo "<H2>Se ha producido un error en la petición</H2>";
    echo "<P>Error: {$e->getMessage()}</P>";
}

//Uso del servicio para enviar datos (formato JSON)

$url = SERVER_URI . 'get.php';
if (isset($resultado) && $resultado->estado == "AUTH_OK" || $resultado->estado == 'READY') {

    $options = ['cookies' => $jar];
    $response = $clienteHTTP->get($url, $options);

    var_dump(json_decode($response->getBody()->getContents()));
} else {
    echo "No se ha podido autenticar en el servicio.";
}

