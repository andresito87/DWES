<?php

require_once('etc/conf.php');
require_once('lib/fpedidos.php');

$errores = [];
$pedido = [];
if ($_POST) //Si hay parámetros $_POST los revisamos
{
    //Verificamos el número de cliente con una expresión regular
    if (isset($_POST['clientnum']) && !preg_match('/^[PIE]\d{5}$/', $_POST['clientnum'])) {
        $errores[] = 'El código de cliente no es correcto.';
    } else {
        $pedido['cliente'] = $_POST['clientnum'];
    }

    if (isset($_POST['fechaent'])) {
        $fecha = date_parse_from_format("d/m/Y", $_POST['fechaent']);
        if ($fecha['error_count'] > 0 || $fecha['warning_count'] > 0) {
            $errores[] = "La fecha no tiene el formato correcto o no existe.";
        } else //Comprobamos que no sea del futuro.
        {
            $fechaHoy = date_create(); //Día de hoy
            $fecha = date_create()->setDate($fecha['year'], $fecha['month'], $fecha['day']);
            if ($fecha <= $fechaHoy) {
                $errores[] = 'La fecha del pedido no puede ser anterior o igual a hoy.';
            } else {
                $pedido['fecha_entrega'] = $_POST['fechaent'];
            }
        }
    }

    if (
        isset($_POST['codigoProducto']) && isset($_POST['unidades']) &&
        is_array($_POST['codigoProducto']) && is_array($_POST['unidades'])
        && count($_POST['codigoProducto']) == count($_POST['unidades'])
    ) {
        reset($_POST['codigoProducto']);
        reset($_POST['unidades']);
        $pedido['lineas'] = [];

        $codProd = current($_POST['codigoProducto']);
        $unidades = current($_POST['unidades']);
        while ($codProd !== false && $unidades !== false) {
            if (!is_numeric($unidades) || $unidades <= 0) {
                if (!empty($codProd)) {
                    $errores[] = "El número de unidades para el producto $codProd no es correcto.";
                }
            } elseif (!existeProducto($codProd, $productos)) {
                $errores[] = "El producto $codProd no existe.";
            } else {
                $pedido['lineas'][] = ['producto' => $codProd, 'unidades' => $unidades];
            }
            $codProd = next($_POST['codigoProducto']);
            $unidades = next($_POST['unidades']);
        }
        if (empty($pedido['lineas'])) {
            $errores[] = "No se ha indicado ninguna línea de pedido.";
        }
    }
}

//Mostraremos el formulario si hay errores (o si estaba vacío de antes) o si no había datos en $_POST
if (empty($_POST) || !empty($errores))
    include_once('formPedido.php');
else {
    $pedido['total'] = costePedido($pedido['lineas'], $productos);
    include_once('proforma.php');
}
