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
    if (is_array($dato) && count($dato) > 1) {
        $textoAMostrar = '<ul>';
        foreach ($dato as $error) {
            $textoAMostrar .= '<li>' . $error . '</li>';
        }
        $textoAMostrar .= '</ul>';
        $r->append('log', 'innerHTML', '<div>' . $textoAMostrar . '</div>');
    } else {
        // transformamos el array en una cadena
        $dato = is_array($dato) ? implode(',', $dato) : $dato;
        $r->append('log', 'innerHTML', '<div>' . $dato . '</div>');
    }
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
        // Limpio los inputs para evitar que si el usuario se desloguea mientras modificaba una ubicación, se muestren esos datos al volver a loguearse. Sería incoherente, son sesiones distintas.
        limpiarInputsAlCompletarOperacion($response);
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
    limpiarZonaLog($response);
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
    <thead><tr><th>Id</th><th>Nombre</th><th>Descripción</th><th>Días</th><th>Acciones</th></tr></thead>';
    foreach ($ubicaciones as $ubicacion) {
        $html .= '<tr><td>' . $ubicacion['id'] . '</td>' . '<td>' . $ubicacion['nombre'] . '</td><td>' . $ubicacion['descripcion'] . '</td><td>' . $ubicacion['dias'] . '</td><td><button onclick="' . rq()->call('enviarDatosUbicacionParaModificar', $ubicacion['id']) . '">Modificar</button>' . '<button onclick="' . rq()->call('eliminarUbicacion', $ubicacion['id']) . '">Eliminar</button></td></tr>';
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

// La funcion crearUbicacion recibe un parametro id de tipo int o string porque habrá veces que siendo entero será que se esta modificando y siendo string será que se esta creando uno nuevo, cadena vacía ''.
function crearUbicacion(int|string $id, array $datos)
{
    $response = new Response();
    $pdo = DB::getConn();
    if (! $pdo) {
        logMessage($response, DB::getLastError());
        return $response;
    }

    if (! usuarioAutenticado($response))
        return $response;

    if (isset($id) && $id !== '') {
        logMessage($response, 'Error: No se puede crear una ubicación con un ID ya existente. Le recomendamos que limpie el formulario y vuelva a intentarlo.');
        return $response;
    }

    $errores = verificarDatosUbicacion($datos);

    if (count($errores) > 0) {
        logMessage($response, $errores);
        return $response;
    }

    $ubicacion = new Ubicacion($datos['nombre'], $datos['descripcion'], implode(',', $datos['dias']));
    $resultado = Ubicacion::crearUbicacion($pdo, $ubicacion->getNombre(), $ubicacion->getDescripcion(), $ubicacion->getDias());

    if ($resultado > 0) {
        cargarListadoUbicaciones($pdo, $response);
        limpiarInputsAlCompletarOperacion($response);
    } else if ($resultado === -1) {
        logMessage($response, 'Error: Operacion en la base de datos fallida.');
    } else if ($resultado === false || $resultado === 0) {
        limpiarInputsAlCompletarOperacion($response);
        logMessage($response, 'Aviso: No se ha modificado ninguna ubicación.');
    }
    return $response;
}

function verificarDatosUbicacion(array $datos)
{
    $errores = [];
    if (! isset($datos['nombre']) || strlen($datos['nombre']) < 5 || strlen($datos['nombre']) > 50)
        $errores[] = 'El nombre de la ubicación debe tener entre 5 y 50 caracteres.';
    if (! isset($datos['descripcion']) || empty($datos['descripcion']))
        $errores[] = 'La descripción de la ubicación no puede estar vacía.';
    if (! isset($datos['dias']) || count($datos['dias']) < 1 || count($datos['dias']) > 7 || count(array_diff($datos['dias'], Ubicacion::DIAS)) > 0 || count(array_unique($datos['dias'])) < count($datos['dias']))
        $errores[] = 'Los días de la ubicación marcados no son válidos.';
    return $errores;
}

function enviarDatosUbicacionParaModificar(int $id)
{
    $response = new Response();

    if (! usuarioAutenticado($response))
        return $response;
    $pdo = DB::getConn();
    if (! $pdo) {
        logMessage($response, DB::getLastError());
        return $response;
    }

    $ubicacion = Ubicacion::obtenerUbicacion($pdo, $id);
    // Aplanamos el array de ubicación
    $ubicacion = $ubicacion[0];

    if (is_array($ubicacion)) {
        $response->assign('id', 'value', $ubicacion['id']);
        $response->assign('nombre', 'value', $ubicacion['nombre']);
        $response->assign('descripcion', 'value', $ubicacion['descripcion']);
        foreach (Ubicacion::DIAS as $dia) {
            if (in_array($dia, explode(',', $ubicacion['dias']))) {
                $response->assign($dia, 'checked', true);
            } else {
                $response->assign($dia, 'checked', false);
            }
        }
    } else {
        logMessage($response, DB::getLastError());
    }
    return $response;
}

function modificarUbicacion(int $id, array $datos)
{
    $response = new Response();

    if (! usuarioAutenticado($response))
        return $response;

    $pdo = DB::getConn();
    if (! $pdo) {
        logMessage($response, DB::getLastError());
        return $response;
    }

    $errores = verificarDatosUbicacion($datos);

    if (count($errores) > 0) {
        logMessage($response, $errores);
        return $response;
    }

    $ubicacion = Ubicacion::obtenerUbicacion($pdo, $id);
    // Aplanamos el array de ubicación
    $ubicacion = $ubicacion[0];

    if (! is_array($ubicacion)) {
        logMessage($response, DB::getLastError());
        return $response;
    }

    $resultado = Ubicacion::modificarUbicacion($pdo, $datos['nombre'], $datos['descripcion'], implode(',', $datos['dias']), $id);

    if ($resultado > 0) {
        cargarListadoUbicaciones($pdo, $response);
        limpiarInputsAlCompletarOperacion($response);
    } else if ($resultado === -1) {
        logMessage($response, 'Error: Operacion en la base de datos fallida.');
    } else if ($resultado === false || $resultado === 0) {
        limpiarInputsAlCompletarOperacion($response);
        logMessage($response, 'Aviso: No se ha modificado ninguna ubicación.');
    }

    return $response;
}

function eliminarUbicacion(int $id)
{
    $response = new Response();
    $pdo = DB::getConn();
    if (! $pdo) {
        logMessage($response, DB::getLastError());
        return $response;
    }

    if (! usuarioAutenticado($response))
        return $response;

    $resultado = Ubicacion::eliminarUbicacion($pdo, $id);
    if ($resultado > 0) {
        cargarListadoUbicaciones($pdo, $response);
    } else {
        logMessage($response, DB::getLastError());
    }
    return $response;
}

function limpiarInputsAlCompletarOperacion(Response $response)
{
    $response->clear('id', 'value');
    $response->clear('nombre', 'value');
    $response->clear('descripcion', 'value');
    foreach (Ubicacion::DIAS as $dia) {
        $response->clear($dia, 'checked');
    }
}

function limpiarDatosFormulario()
{
    $response = new Response();
    $response->clear('id', 'value');
    $response->clear('nombre', 'value');
    $response->clear('descripcion', 'value');
    foreach (Ubicacion::DIAS as $dia) {
        $response->clear($dia, 'checked');
    }
    return $response;
}


function limpiarZonaLog(Response $response)
{
    $response->clear('log', 'innerHTML');
    $response->assign('log', 'innerHTML', '<H1>Mensajes de LOG:</H1>');
}


$jaxon->register(Jaxon::CALLABLE_FUNCTION, 'login');
$jaxon->register(Jaxon::CALLABLE_FUNCTION, 'logout');
$jaxon->register(Jaxon::CALLABLE_FUNCTION, 'establecerInterfaz');
$jaxon->register(Jaxon::CALLABLE_FUNCTION, 'cargarListadoUbicaciones');
$jaxon->register(Jaxon::CALLABLE_FUNCTION, 'crearUbicacion');
$jaxon->register(Jaxon::CALLABLE_FUNCTION, 'eliminarUbicacion');
$jaxon->register(Jaxon::CALLABLE_FUNCTION, 'enviarDatosUbicacionParaModificar');
$jaxon->register(Jaxon::CALLABLE_FUNCTION, 'modificarUbicacion');
$jaxon->register(Jaxon::CALLABLE_FUNCTION, 'limpiarInputsAlCompletarOperacion');
$jaxon->register(Jaxon::CALLABLE_FUNCTION, 'limpiarDatosFormulario');


