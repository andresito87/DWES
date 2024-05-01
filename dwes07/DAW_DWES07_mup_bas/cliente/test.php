<?php
/**
 * Ejemplo de script que realiza una petición 
 */
require_once __DIR__.'/vendor/autoload.php';
require_once __DIR__.'/conf.php';


$clienteHTTP=new GuzzleHttp\Client();

$url=DUMPER_URI;

$options2=['json'=>['dato'=>'test']];
$response = $clienteHTTP->post($url,$options2);  
          
var_dump(json_decode($response->getBody()->getContents()));
var_dump($response->getHeaders());

