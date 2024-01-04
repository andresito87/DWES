<?php
require_once './src/conn.php';

/**
 * @description Funcion para obtener el usuario de la base de datos y comprobar si existe
 * @file userauth.php
 * @param string $dni DNI del usuario
 * @param string $password Contraseña del usuario
 * @return array|bool Devuelve un array con los datos del usuario o false si no existe
 * @author andres
 * @date 2023/01/04
 */
function recuperar_usuario_valido($dni, $password): array|bool
{
    //Conectamos a la base de datos para comenzar las comprobaciones del usuario
    $con = connect();

    //Creamos la consulta parametrizada para comprobar el usuario y las credenciales, volcadas a la variable
    $sql = "SELECT id,dni,nombre,apellidos,roles FROM empleados WHERE dni=:dni AND password=:pass";
    $fila = [];
    try {
        //preparamos la consulta
        $resultado = $con->prepare($sql);
        //Parametros de la consulta
        $resultado->bindValue(":dni", $dni);
        $password_invertida_salpimentada = hash('sha256', $dni . $password . strrev($dni . $password) . '495k5ndikakzFSKZssd');
        $resultado->bindValue(":pass", $password_invertida_salpimentada);
        //Ejecutamos la consulta
        if ($resultado->execute()) {
            //Volcamos los resultados en un array
            $fila = $resultado->fetch();
        } else
            $error = "Error al ejecutar la consulta.";
    } catch (PDOException $e) {
        $error = "Error en la base de datos al ejecutar la consulta.";
    }
    //Cerramos la conexion
    $con = null;
    $resultado = null;
    //Devolvemos el array con los datos del usuario o false si no existe o hay algun error
    return isset($error) ? false : $fila;
}

/**
 * @description Funcion para comprobar si el usuario tiene el rol indicado
 * @file userauth.php
 * @param string $rol Rol del usuario
 * @return bool Devuelve true si el usuario tiene el rol indicado o false si no lo tiene
 */
function verificacion_rol_de_sesion($rol): bool
{
    //Comprobamos si existe la sesion
    if (!isset($_SESSION['auth'])) {
        session_start();
        if (!isset($_SESSION['auth']['roles'])) {
            return false;
        }
    }
    return $_SESSION['auth']['roles'] == $rol;
}

/**
 * @description Funcion para comprobar si el empleado tiene asignado el seguimiento
 * @file userauth.php
 * @param PDO $pdo Conexion a la base de datos
 * @param int $idSeguimiento ID del seguimiento
 * @return bool Devuelve true si el empleado tiene asignado el seguimiento o false si no lo tiene
 */
function verificacion_empleado_asignado_a_seguimiento($pdo, $idSeguimiento): bool
{
    //Comprobamos si existe la sesion
    if (!isset($_SESSION['auth'])) {
        session_start();
        if (!isset($_SESSION['auth']['id'])) {
            return false;
        }
    }
    $sql = "SELECT empleados_id FROM seguimiento WHERE id=:idSeguimiento";
    $resultado = $pdo->prepare($sql);
    $resultado->bindValue(":idSeguimiento", $idSeguimiento);
    $resultado->execute();
    $idEmpleado = $resultado->fetch();
    $resultado = null;
    return $idEmpleado[0] == $_SESSION['auth']['id'];
}
