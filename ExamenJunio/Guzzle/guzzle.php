<?php
require __DIR__ . '/vendor/autoload.php';

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ConnectException;

// Ejercicio: REALIZAR PETICIONES CON GUZZLE A UNA API


define('URL', 'https://dummyjson.com/'); // URL de la API
try {
    $client = new Client(['http_errors' => false]); // Creación del cliente para realizar peticiones

    // <-------TIPO GET: Obtener todos los productos ------->
    $res = $client->request('GET', URL . 'products'); // Realizo petición tipo get a productos

    if ($res->getStatusCode() == '200') { // Compruebo que la petición sea satisfactoria
        $datosRecibidos = $res->getBody()->getContents(); // Obtengo el contenido de la peticion
        $json = json_decode($datosRecibidos, true); // Decodifico JSon a array asociativo

        $productos = '';
        echo '<h2>Listado de productos:</h2>';
        foreach ($json as $key => $value) {
            if (is_array($value)) {
                foreach ($value as $producto) {
                    /*echo '<pre>';
                    var_dump($producto['title']);
                    echo '</pre>';*/
                    $productos .= $producto['title'] . '<BR>';
                }
            }
        }
        echo $productos;
    } else {
        echo 'Revisa: Api contesta con código de estado ' . $res->getStatusCode() . ' al endpoint ' . URL . 'products'; // Muestro el error de la peticion
    }
} catch (ConnectException | ClientException $exception) { // Control de errores en la realización de la petición
    die('Error en la realización de la petición');
}

// <------ TIPO POST: Añadir un producto ------>

try {
    $res = $client->post(URL . 'products/add', [
        'headers' => ['Content-Type' => 'application/json'],
        'body' => json_encode(
            ['title' => 'Portátil'],
            JSON_PRETTY_PRINT)
    ]);
    if ($res->getStatusCode() == '200') { // Compruebo que la petición sea satisfactoria
        $datosRecibidos = $res->getBody()->getContents(); // Obtengo el contenido de la peticion
        $json = json_decode($datosRecibidos, true); // Decodifico JSon a array asociativo
        echo '<h2>Producto añadido:</h2>';
        array_walk($json, function ($value, $key) { // Recorro el array
            echo $key . ':' . $value . '<BR>'; // Muestro la información
        });
    } else {
        echo 'Revisa: Api contesta con código de estado ' . $res->getStatusCode() . ' al endpoint ' . URL . 'products/add'; // Muestro el error de la peticion
    }

} catch (ConnectException | ClientException $exception) { // Control de errores en la realización de la petición
    die('Error en la realización de la petición');
}

// <------ TIPO DELETE: Eliminar un producto ------>

try {
    $res = $client->delete(URL . 'products/4', [
        'headers' => ['Content-Type' => 'application/json']
    ]);
    if ($res->getStatusCode() == '200') { // Compruebo que la petición sea satisfactoria
        $datosRecibidos = $res->getBody()->getContents(); // Obtengo el contenido de la peticion
        $json = json_decode($datosRecibidos, true); // Decodifico JSon a array asociativo
        echo '<h2>Producto eliminado:</h2>';
        array_walk($json, function ($value, $key) {
            if (is_array($value)) {
                array_walk($value, function ($value, $key) {
                    echo $key . ':' . $value . '<BR>';
                });
            } else
                echo $key . ':' . $value . '<BR>';
        });
    } else {
        echo 'Revisa: Api contesta con código de estado ' . $res->getStatusCode() . ' al endpoint ' . URL . 'products/1'; // Muestro el error de la peticion
    }

} catch (ConnectException | ClientException $exception) { // Control de errores en la realización de la petición
    die('Error en la realización de la petición');
}

// <------ TIPO POST: Login de usuario ------>

try {
    $res = $client->post(URL . 'auth/login', [
        'headers' => ['Content-Type' => 'application/json'],
        'body' => json_encode([
            'username' => 'kminchelle',
            'password' => '0lelplR',
            'expiresInMins' => 30],
            JSON_PRETTY_PRINT)
    ]);
    if ($res->getStatusCode() == '200') { // Compruebo que la petición sea satisfactoria
        $datosRecibidos = $res->getBody()->getContents(); // Obtengo el contenido de la peticion
        $json = json_decode($datosRecibidos, true); // Decodifico JSon a array asociativo
        echo '<h2>Usuario logueado:</h2>';
        array_walk($json, function ($value, $key) { // Recorro el array
            echo $key . ':' . $value . '<BR>'; // Muestro la información
        });
    } else {
        echo 'Revisa: Api contesta con código de estado ' . $res->getStatusCode() . ' al endpoint ' . URL . 'auth/login'; // Muestro el error de la peticion
    }
} catch (ConnectException | ClientException $exception) { // Control de errores en la realización de la petición
    die('Error en la realización de la petición');
}

?>