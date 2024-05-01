<?php

session_start();

if (!$_SESSION['auth'] || $_SERVER['REQUEST_METHOD']!='POST') 
    die(json_encode(['error'=>'Petición no esperada']));

$archivo=__DIR__.'/datos/monumentos.ser';

//Obtenemos los datos para deserializar
$monumentos=unserialize(file_get_contents($archivo));

//$datos recibidos
$datos=json_decode(file_get_contents('php://input'));

$respuesta=new stdClass;
$respuesta->resultado='ERROR';
if ($datos!==false 
    && isset($datos->provincia) && is_string($datos->provincia) 
    && isset($datos->nombre) && is_string($datos->nombre) 
    && isset($datos->latitud) && is_numeric($datos->latitud)
    && isset($datos->longitud) && is_float($datos->longitud)     
    && isset($monumentos[$datos->provincia]))
{
    $monumentos[$datos->provincia][] = 
        ['nombre'=>$datos->nombre, 
         'latitud'=>$datos->latitud, 
         'longitud'=>$datos->longitud, 
         'id'=>uniqid()];
    file_put_contents($archivo,serialize($monumentos));
    $respuesta->resultado='OK';
}

header("Content-Type","application/json");
die(json_encode($respuesta));
