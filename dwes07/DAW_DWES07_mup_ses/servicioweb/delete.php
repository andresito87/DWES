<?php

session_start();

if (!$_SESSION['auth'] || $_SERVER['REQUEST_METHOD']!='DELETE') 
    die(json_encode(['error'=>'Petición no esperada']));

$archivo=__DIR__.'/datos/monumentos.ser';

//Obtenemos los datos para deserializar
$monumentos=unserialize(file_get_contents($archivo));

//$datos recibidos
$datos=json_decode(file_get_contents('php://input'));

$respuesta=new stdClass;
$respuesta->resultado='ERROR';
if ($datos!==false && isset($datos->id) && is_string($datos->id))
{
    $encontrado=false;
    foreach($monumentos as &$provincia)
        foreach ($provincia as $pos=>$monumento)
            if ($monumento['id']===$datos->id)
            {
                unset ($provincia[$pos]);
                $encontrado=true;
                break 2;
            }    
    if ($encontrado)
    {
        file_put_contents($archivo,serialize($monumentos));
        $respuesta->resultado='BORRADO';
    }
    else
        $respuesta->resultado='NO_ENCONTRADO';    
}

header("Content-Type","application/json");
die(json_encode($respuesta));