<?php

define('AUTH_REQUIRED',true);
require_once 'boot.php';

if ($metodoHTTP==='PUT')
{
    $r=json_decode(file_get_contents("php://input"));            
    if (is_object($r) && isset($r->numero_actual) && in_array($r->numero_actual,$datos)
        && isset($r->numero_nuevo) && preg_match('/^\d+$/',$r->numero_nuevo)
        && !in_array(intval($r->numero_nuevo),$datos))
    {        
        $datos[array_search($r->numero_actual,$datos)]=intval($r->numero_nuevo);
        $res=true;
    }
    echo json_encode(['resultado'=>$res??false]); 
}
else
{
   echo json_encode(["error"=>"Método no implementado en ".__FILE__]);
}