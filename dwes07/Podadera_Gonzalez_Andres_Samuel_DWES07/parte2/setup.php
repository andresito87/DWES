<?php
require_once __DIR__ . '/comun.php';

use Jaxon\Jaxon;
use Jaxon\Response\Response;
use DWES07\model\Ubicacion;
use DWES07\model\Empleado;

$jaxon = jaxon();
$jaxon->setOption("js.lib.uri", BASE_URL . "jaxon-dist");
$jaxon->setOption('core.request.uri', BASE_URL . 'backend.php');

function logMessage(Response $r, mixed $dato)
{
    $r->append('log', 'innerHTML', '<div>' . print_r($dato, true) . '</div>');
}

function login($dni, $password)
{
    $response = new Response();
    $response->clear('login_dni', 'value');
    $response->clear('login_password', 'value');
    $response->assign('listaUbicaciones', 'innerHTML', '//GENERAR AQUÍ LISTA DE UBICACIONES');
    $pdoConn = DB::getConn();
    if (! $pdoConn) {
        logMessage($response, DB::getLastError());
        return $response;
    }

    $empleado = Empleado::verificarEmpleado($pdoConn, $dni, $password);
    if (is_array($empleado)) {
        $_SESSION['usuario'] = $empleado;
        usuarioAutenticado($response);
        cargarListadoUbicaciones($pdoConn, $response);
    } else {
        $response->alert("El usuario y password indicado no son válidos.");
    }
    return $response;
}

function logout()
{
    $response = new Response();
    $response->clear('login_usuario', 'value');
    $response->clear('login_password', 'value');
    $response->clear('listaUbicaciones', 'innerHTML');
    unset($_SESSION['usuario']);
    usuarioAutenticado($response);
    return $response;
}

function usuarioAutenticado(Response $response)
{
    if (! isset($_SESSION['usuario'])) {
        $response->clear('login_usuario', 'value');
        $response->clear('login_password', 'value');
        $response->assign('listaUbicaciones', 'innerHTML', 'MOSTRAR AQUÍ LISTA DE UBICACIONES');
        $response->assign('formulario_autenticacion', 'style.display', 'block');
        $response->assign('area_autenticada', 'style.display', 'none');
        return false;
    } else {
        $response->assign('formulario_autenticacion', 'style.display', 'none');
        $response->assign('area_autenticada', 'style.display', 'block');
        return true;
    }
}

function cargarListadoUbicaciones(PDO $pdo, Response $response)
{
    $ubicaciones = Ubicacion::listarUbicaciones($pdo);
    $html = '<table border="1"> 
    <thead><tr><th>Nombre</th><th>Descripción</th><th>Días</th></tr></thead>';
    foreach ($ubicaciones as $ubicacion) {
        $html .= '<tr><td>' . $ubicacion['nombre'] . '</td><td>' . $ubicacion['descripcion'] . '</td><td>' . $ubicacion['dias'] . '</td></tr>';
    }
    $html .= '</table>';
    $response->assign('listaUbicaciones', 'innerHTML', $html);
}

function establecerInterfaz()
{
    usuarioAutenticado($r = new Response());
    cargarListadoUbicaciones(DB::getConn(), $r);
    return $r;
}


$jaxon->register(Jaxon::CALLABLE_FUNCTION, 'login');
$jaxon->register(Jaxon::CALLABLE_FUNCTION, 'logout');
$jaxon->register(Jaxon::CALLABLE_FUNCTION, 'establecerInterfaz');
$jaxon->register(Jaxon::CALLABLE_FUNCTION, 'cargarListadoUbicaciones');
