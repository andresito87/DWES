<?php

//Script que retorna los datos recibidos en la petición HTTP como un documento JSON
//Además, lo escribe en el archivo log.txt

$datosRecv=new stdClass;

if (function_exists('apache_request_headers'))
    $datosRecv->cabecerasPeticion=apache_request_headers();
$datosRecv->datosSERVER=$_SERVER;
$datosRecv->datosPOST=$_POST;
$datosRecv->datosGET=$_GET;
$datosRecv->cuerpoMensaje=file_get_contents('php://input');

header("Content-Type","application/json");

file_put_contents(__DIR__.'/log.txt',json_encode($datosRecv,JSON_PRETTY_PRINT));

die(json_encode($datosRecv));
