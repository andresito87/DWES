<?php

require __DIR__ . '/vendor/autoload.php';

use DWES04SOL\controladores\TalleresController;

$pdo = require __DIR__ . '/conectarbd.php';

$smarty = new Smarty;
$smarty->setTemplateDir(__DIR__ . '/resources/templates');
$smarty->setCompileDir(__DIR__ . '/resources/compiled_templates');
$smarty->setCacheDir(__DIR__ . '/resources/smarty_cache');

$peticion = new Peticion();
$accion = $peticion->has('accion') ? strtolower($peticion->getString('accion')) : '';

switch ($accion) {
    case 'nuevo_taller_form':
        if ($peticion->isGet()) {
            TalleresController::nuevoTallerForm($smarty);
        } else {
            header("Location:index.php");
            exit;
        }
        break;
    case 'crear_taller':
        if ($peticion->isPost()) {
            TalleresController::crearTaller($pdo, $smarty, $peticion);
        } else {
            header("Location:index.php");
            exit;
        }
        break;
    case 'borrar_taller':
        TalleresController::borrarTaller($pdo, $smarty, $peticion);
        break;
    default:
        TalleresController::listarTalleres($pdo, $smarty, $peticion);
        break;
}
