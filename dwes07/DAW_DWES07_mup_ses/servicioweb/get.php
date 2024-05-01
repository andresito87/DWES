<?php

session_start();

if (!$_SESSION['auth'] || $_SERVER['REQUEST_METHOD']!='GET') 
    die(json_encode(['error'=>'Petición no esperada']));

$archivo=__DIR__.'/datos/monumentos.ser';

//Obtenemos los datos para deserializar
$monumentos=unserialize(file_get_contents($archivo));

header("Content-Type","application/json");
die(json_encode($monumentos));
