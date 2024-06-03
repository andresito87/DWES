<?php

define('ARCHIVO_DATOS_SERIALIZADOS', __DIR__ . DIRECTORY_SEPARATOR . 'datos' . DIRECTORY_SEPARATOR . 'datos.ser');
header('Content-type: application/json');
$contenidoArchivo = @file_get_contents(ARCHIVO_DATOS_SERIALIZADOS);
if ($contenidoArchivo !== false)
    $datos = unserialize($contenidoArchivo);
else
    $datos = [];

function guardarDatos($datos)
{
    file_put_contents(ARCHIVO_DATOS_SERIALIZADOS, serialize(array_values($datos)));
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    echo json_encode(['videojuegos' => $datos]);
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //Leemos los datos "RAW" recibidos
    $datosJSONrecibidos = file_get_contents("php://input");
    //TODO: decodificar los datos JSON recibidos y, si son correctos, guardarlos.
    $json = json_decode($datosJSONrecibidos, true);
    if ($json !== false && is_array($json)) {
        if (! isset($json['nombre']) || empty($json['nombre'])) {
            $error[] = "Falta nombre";
        }
        if (! isset($json['year']) || empty($json['year']) || ! is_numeric($json['year'])) {
            $error[] = "Falta año";
        }
        if (! isset($error)) {
            $datos[] = [$json['nombre'], $json['year']];
            guardarDatos($datos);
            echo json_encode(['RESULTADO' => "OK"]);
        } else {
            echo json_encode(['ERROR' => $error], JSON_PRETTY_PRINT);
        }
    }
} else {
    echo json_encode(['RESULTADO' => 'ERROR. Método no implementado']);
}

