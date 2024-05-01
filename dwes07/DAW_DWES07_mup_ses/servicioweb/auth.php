<?php
/**
 * Tipo de petición esperado:
 *  
 *  POST
 *  Content-Type: x-www-form-urlencoded
 *   
 * Script para realizar la autenticación usando sesiones.
 * Retorna una respuesta JSON con lo siguientes datos:
 * {
 *    "estado":<ESTADO>
 * }
 * Donde <ESTADO> puede ser:
 *  - AUTH_INCOMPLETA: Los datos necesarios para la autenticación no están presentes.
 *  - AUTH_OK: La autenticación se realizo con éxito.
 *  - AUTH_FALLO: La autenticación fallo (usuario o contraseña erróneos).
 *  - READY: Ya había información de autenticación.
 */
require_once __DIR__.'/libs/functions.php';

$respuesta = new stdClass;
session_start();
if (!isset($_SESSION['auth'])) //Si no está autenticado previamente
{
    $user = filter_input(INPUT_POST, 'user');
    $pwd = filter_input(INPUT_POST, 'pwd');    
    $respuesta->estado = 'AUTH_INCOMPLETA';
    //Si no está autenticado previamente, miramos user/pwd vía POST
    if (is_string($user) && is_string($pwd)) {
        if (usuarioValido($user, $pwd)) {
            $respuesta->estado = 'AUTH_OK';
            $_SESSION['auth'] = $user;
        } else
            $respuesta->estado = 'AUTH_FALLO';
    }
    
}
else $respuesta->estado = 'READY';

header("Content-Type","application/json");
die(json_encode($respuesta));