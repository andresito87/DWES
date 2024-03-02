<?php
require_once __DIR__ . '/vendor/autoload.php';

use DWES04\models\Peticion;
use DWES04\controllers\Controladores;
use DWES04\exceptions\AppException;
use DWES04\DB;

//Conexión a la base de datos:
try {
    $pdo = DB::obtenerConexion();
} catch (AppException $e) {
    echo $e->getMessage();
    exit();
} catch (PDOException $e) {
    echo $e->getMessage();
    exit();
}

//Configuramos Smarty:
$smarty = new Smarty();
$smarty->setTemplateDir(__DIR__ . TEMPLATE_DIR);
$smarty->setCompileDir(__DIR__ . TEMPLATE_C_DIR);
$smarty->setCacheDir(__DIR__ . CACHE_DIR);

// Verificar si se recibieron datos por POST
if (isset($_POST) && !empty($_POST)) {
    // Crear un objeto Peticion con los datos recibidos por POST
    $post = new Peticion(Peticion::POST);
} else {
    // Crear un objeto Peticion con los datos recibidos por GET
    $post = new Peticion(Peticion::GET);
}

// Verificamos si se recibió una acción por GET, el valor del parámetro 'accion' será el que determine el flujo de la aplicación
$accion = filter_input(INPUT_GET, 'accion', FILTER_SANITIZE_SPECIAL_CHARS);

// Enrutador, determina en función del valor del parámetro 'accion', el controlador que se ha de ejecutar
switch ($accion) {
    // Accion de mostrar el formulario para crear un nuevo taller
    case "nuevo_taller_form":
        Controladores::nuevoTallerForm($smarty);
        break;
    // Accion de crear un nuevo taller
    case "crear_taller":
        Controladores::nuevoTaller($pdo, $smarty, $post);
        break;
    // Accion de borrar un taller
    case "borrar_taller":
        Controladores::borrarTaller($pdo, $smarty, $post);
        break;
    // Accion de mostrar el formulario para editar un taller
    case "editar_taller_form":
        Controladores::editarTallerForm($pdo, $smarty, $post);
        break;
    // Accion de editar un taller
    case "editar_taller":
        Controladores::editarTaller($pdo, $smarty, $post);
        break;
    // Accion de mostrar el listado de talleres(por defecto)
    default:
        Controladores::accionPorDefecto($pdo, $smarty, $post);
        break;
}