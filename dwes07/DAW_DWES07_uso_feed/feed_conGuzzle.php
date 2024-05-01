<?php

require_once __DIR__.'/vendor/autoload.php';

//Creamos un cliente HTTP
$clienteHTTP=new GuzzleHttp\Client();
//Iniciamos una petición GET
$url="http://www.juntadeandalucia.es/educacion/portals/delegate/rss/ced/portalconsejeria/alumnado/-/-/false/OR/true/ishare_noticefrom/DESC/";
$respuesta=$clienteHTTP->request('GET',$url, ['verify'=>__DIR__.'/juntadeandalucia-es.pem']);
//Obtenemos los datos del cuerpo del mensaje
echo $respuesta->getBody();