<?php

define('AUTH_REQUIRED',true);
require_once 'boot.php';

if ($metodoHTTP==='DELETE')
{
    $r=json_decode(file_get_contents("php://input"));            
    if (is_object($r) && isset($r->numero) && in_array($r->numero,$datos))
    {
        unset($datos[array_search($r->numero,$datos)]);
        $res=true;
    }
    echo json_encode(['resultado'=>$res??false]); 
}
else
{
   echo json_encode(["error"=>"Método no implementado en ".__FILE__]);
}