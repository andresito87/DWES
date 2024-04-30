<?php

define('AUTH_REQUIRED',true);
require_once 'boot.php';

if ($metodoHTTP==='POST')
{
    $numero=filter_input(INPUT_POST,'numero',FILTER_VALIDATE_INT);
    if ($numero!==false && $numero!==null 
        && preg_match('/^\d+$/',$numero) 
        && count($datos)<10 && !in_array($numero,$datos)) 
    {   
        $datos[]=intval($numero);
        $res=true;
    }
    echo json_encode(['resultado'=>$res??false]);
}
else
{
   echo json_encode(["error"=>"Método no implementado en ".__FILE__]);
}