<?php
require_once __DIR__ . '/comun.php';

use Jaxon\Jaxon;
use Jaxon\Response\Response;
use DWES07\model\Ubicacion;
use DWES07\model\Empleado;


$jaxon = jaxon();
$jaxon->setOption("js.lib.uri", BASE_URL . "jaxon-dist");
$jaxon->setOption('core.request.uri', BASE_URL . 'backend.php');

/**
 * Añade un mensaje al log
 */
function logMessage(Response $r, mixed $dato)
{
    $r->append('log', 'innerHTML', '<div>' . print_r($dato, true) . '</div>');
}


function login($dni, $password)
{
    $response = new Response();
    $response->clear('login_dni', 'value');
    $response->clear('login_password', 'value');
    $response->clear('listaUbicaciones', 'innerHTML');
    $pdoConn = DB::getConn();
    if (!$pdoConn) {
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
    if (!isset($_SESSION['usuario'])) {
        $response->clear('login_usuario', 'value');
        $response->clear('login_password', 'value');
        $response->clear('listaUbicaciones', 'innerHTML');
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
    $productos = Ubicacion::listar($pdo);
    $result = file_get_contents(__DIR__ . '/htmlfragments/ubicacionestableheader.html');
    foreach ($productos as $producto) :
        $result .= '<tr>';
        $result .= '<td>' . $producto->getId() . '</td>';
        $result .= '<td>' . $producto->getNombre() . '</td>';
        $result .= '<td>' . $producto->getDescripcion() . '</td>';
        $result .= '<td>' . implode(' - ', $producto->getDias()) . '</td>';
        $result .= '</tr>';
    endforeach;
    $result .= file_get_contents(__DIR__ . '/htmlfragments/ubicacionestablefooter.html');
    $response->assign('listaUbicaciones', 'innerHTML', $result);
}

function listarUbicaciones(?Response $response = null)
{
    $response = ($response instanceof Response) ? $response : new Response();

    if (!usuarioAutenticado($response)) return $response;

    $pdoConn = DB::getConn();
    if (!$pdoConn) {
        logMessage($response, DB::getLastError());
    } else {
        cargarListadoUbicaciones($pdoConn, $response);
    }

    return $response;
}

function nuevaUbicacion($data)
{
    $response = new Response();

    $pdoConn = DB::getConn();
    if (!$pdoConn) {
        logMessage($response, DB::getLastError());
        return $response;
    }

    if (!usuarioAutenticado($response)) return $response;

    $response->append('log', 'innerHTML', "<P>Datos nueva ubicación: " . print_r($data, true) . " </P>");
    $u = new Ubicacion();
    $errors = [];
    if (!isset($data['nombre']) || !$u->setNombre($data['nombre'])) {
        $errors = ["No se ha indicado el nombre o no está entre 5 y 50 caracteres."];
    }
    if (!isset($data['descripcion']) || !$u->setDescripcion($data['descripcion'])) {
        $errors = ["No se ha indicado la descripcion"];
    }
    if (!isset($data['dias']) || !$u->setDias($data['dias'])) {
        $errors = ["No se han indicado los dias o no son correctos"];
        logMessage($response, $u);
    }
    if ($errors) {
        $response->alert("Errores encontrados:\n" . implode('\n', $errors));
    } else {
        $u->guardar($pdoConn);
    }
    return listarUbicaciones($response);
}


$jaxon->register(Jaxon::CALLABLE_FUNCTION, 'login');
$jaxon->register(Jaxon::CALLABLE_FUNCTION, 'logout');
$jaxon->register(Jaxon::CALLABLE_FUNCTION, 'listarUbicaciones');
$jaxon->register(Jaxon::CALLABLE_FUNCTION, 'nuevaUbicacion');
