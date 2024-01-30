<?php

require_once __DIR__.'/etc/conf.php';

if (session_status()==PHP_SESSION_NONE)
{
    session_start();
}

$now=time();
//Si aparece el timestamp Y no se supera el tiempo límite --> se renueva
if (isset($_SESSION['timestamp']) && $now-$_SESSION['timestamp']<=LIMITE_INACTIVIDAD)
{
    $_SESSION['timestamp']=$now;    
}
//Si aparece el timestamp o se ha superado el tiempo límite--> se borra información de sesión
elseif (isset($_SESSION['timestamp']))
{
    unset($_SESSION['empleado']);
    unset($_SESSION['timestamp']);
}

//Si no existe $_SESSION['empleado'] que contendrá los datos del empleado autenticado, se reenvía a login.php
if (!defined('DO_NOT_REDIRECT') && !isset($_SESSION['empleado']))
{
    header('Location: login.php');
    exit;
}