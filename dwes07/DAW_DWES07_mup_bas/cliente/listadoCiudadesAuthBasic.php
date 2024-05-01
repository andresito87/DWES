<?php

require_once __DIR__.'/vendor/autoload.php';
require_once __DIR__.'/conf.php';

/**
 * Conexión a un servicio remoto enviando autenticación
 * usando HTTP Basic
 */

//Creamos un cliente HTTP con Guzzle
$clienteHTTP=new GuzzleHttp\Client();

// Establecemos los datos de autenticación (podrían estar en conf.php)
$usuario = 'ejemplo';
$password= 'ejemplo*';

// Preparamos los encabezados de autenticación conforme a HTTP Basic
$datosDeAutenticacion = base64_encode($usuario . ':' . $password);
$headers = [
    'Authorization' => 'Basic ' . $datosDeAutenticacion
];

$url=SERVER_URI.'obtenerListadoCiudades_AUTHBASIC.php';

try {
    // Enviar una solicitud GET al recurso protegido con los encabezados de autenticación
    $response = $clienteHTTP->request('GET', $url, ['headers' => $headers]);

    // Obtener el cuerpo de la respuesta
    $body = $response->getBody();

    // Usar los datos de la respuesta
    var_dump(json_decode($body));
} catch (GuzzleHttp\Exception\RequestException $e) {    
    if ($e->getResponse()->getStatusCode()==401) //Error en la autenticación HTTP Basic
    {
        echo "<H2>Usuario y/o contraseña incorrectos</H2>";
    }
    else
    {
        echo "<H2>Se ha producido un error en la petición</H2>";
        echo "<P>Error: {$e->getMessage()}</P>";
    }
}