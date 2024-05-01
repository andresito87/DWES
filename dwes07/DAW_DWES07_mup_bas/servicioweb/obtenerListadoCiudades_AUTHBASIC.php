<?php
require_once __DIR__.'/libs/functions.php';
$requiereAutenticacion=true;
if (isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['PHP_AUTH_PW'])) {
    $user=$_SERVER['PHP_AUTH_USER'];
    $passwd=$_SERVER['PHP_AUTH_PW'];
    $requiereAutenticacion=!usuarioValido($user,$passwd);    
}

if ($requiereAutenticacion)
{
    header('WWW-Authenticate: Basic realm="APP"');
    header('HTTP/1.0 401 Unauthorized');        
    exit();
}

$resultado=['estado'=>'ERROR','monumentos'=>null];
$monumentosfile=__DIR__.'/datos/monumentos.json';
if (file_exists($monumentosfile))
{
    $resultado['estado']='OK';
    $resultado['monumentos']=json_decode(file_get_contents($monumentosfile));
}
header('Content-Type','application/json');
die(json_encode($resultado));