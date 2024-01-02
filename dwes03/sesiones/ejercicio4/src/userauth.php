<?php
require_once './src/conn.php';

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
    //Devolvemos el mensaje de error o el array con los resultados
    return isset($error) ? false : $fila;
}

function verificacion_rol_de_sesion($rol): bool
{
    return $_SESSION['auth']['roles'] == $rol;
}

function verificacion_empleado_asignado_a_seguimiento($pdo, $idSeguimiento): bool
{
    $sql = "SELECT empleados_id FROM seguimiento WHERE id=:idSeguimiento";
    $resultado = $pdo->prepare($sql);
    $resultado->bindValue(":idSeguimiento", $idSeguimiento);
    $resultado->execute();
    $idEmpleado = $resultado->fetch();
    $resultado = null;
    return $idEmpleado[0] == $_SESSION['auth']['id'];
}
