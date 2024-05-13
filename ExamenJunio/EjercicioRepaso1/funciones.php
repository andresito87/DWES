<?php
define('DATOS_SER', __DIR__ . DIRECTORY_SEPARATOR . 'datos.ser');

function guardarEmpresa($datos) : bool
{
    $guardar = true;
    $empresas = cargarEmpresas();
    $nombres_empresas = array_column($empresas, 'nombre_empresa');
    if (! in_array($datos['nombre_empresa'], $nombres_empresas)) {
        $empresas[] = $datos;
    } else {
        $guardar = false;
    }

    if ($guardar) {
        file_put_contents(DATOS_SER, serialize($empresas));
    }

    return $guardar;
}

function cargarEmpresas() : array
{
    $datos = @file_get_contents(DATOS_SER);
    $datos_des = [];

    if ($datos !== false) {
        $datos_des = unserialize($datos);
        if (! is_array($datos_des)) {
            $datos_des = [];
        }
    }

    return $datos_des;
}

function borrarEmpresa($nombre_empresa) : bool
{
    $guardar = false;
    $empresas = cargarEmpresas();
    foreach ($empresas as $index => $empresa) {
        if ($empresa['nombre_empresa'] == $nombre_empresa) {
            unset($empresas[$index]);
            $guardar = true;
            break; // Termina el bucle una vez que se elimina la empresa
        }
    }
    if ($guardar) {
        file_put_contents(DATOS_SER, serialize($empresas));
    }

    return $guardar;
}
?>