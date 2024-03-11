<?php

require __DIR__.'/vendor/autoload.php';

use IMPR\controladores\ControladoresImpresoras as Controller;

$pdo=new PDO('mysql:host=127.0.0.1;dbname=impresoras_db','root','');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$smarty = new Smarty();
$smarty->template_dir = __DIR__ . '/templates';
$smarty->compile_dir = __DIR__ . '/templates_c';
$smarty->cache_dir = __DIR__ . '/cache';

switch ($_GET['accion']??'')
{
    case 'guardar_impresora':
        Controller::guardarImpresora($pdo,$smarty);
    break;
    case 'form_crear_impresora':
        Controller::formCrearImpresora($smarty);
    break;
    default:
        Controller::listarImpresoras($pdo,$smarty);
    break;
}

