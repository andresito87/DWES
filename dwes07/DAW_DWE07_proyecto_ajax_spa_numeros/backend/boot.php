<?php
include 'funcs.php';

session_start();

if (defined('AUTH_REQUIRED'))
{
    if (!comprobarSiAutenticado()) die (json_encode(['error'=>'login_required']));
    if (!isset($_SESSION['datos'])) $_SESSION['datos']=[rand(1,100),rand(1,100)];    
    $datos=&$_SESSION['datos']; //creamos una referencia para manejar mejor los datos de la sesión 
}

$metodoHTTP=$_SERVER['REQUEST_METHOD'];
