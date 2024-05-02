<?php

require_once 'boot.php';

if ($metodoHTTP==='POST')
{
    $usuario=filter_input(INPUT_POST,'usuario',FILTER_SANITIZE_SPECIAL_CHARS);
    $password=filter_input(INPUT_POST,'password',FILTER_SANITIZE_SPECIAL_CHARS);
    if (comprobarUsuario($usuario,$password))
    {        
        echo json_encode(['access_granted'=>true]);    
    }
    else
    {
        echo json_encode(['access_granted'=>false,'data_recived'=>print_r($_POST,true)]);    
    }
}
else
{
   echo json_encode(["error"=>"Método no implementado en ".__FILE__]);
}