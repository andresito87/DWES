<?php

/**
 * @modulo      Desarrollo de aplicaciones Web Entorno Sevidor
 * @Tema        Desarrollo de aplicaciones Web con PHP
 * @Unidad      3
 * @Ejemplo     Tienda web: login.php
 */
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/funciones/util.php';

// Recuperamos la información de la sesión si el usuario ya se habia autentificado
session_start();
if (isset($_SESSION['usuario'])) {
    header("Location: productos.php");
}

// Comprobamos si ya se ha enviado el formulario
if (isset($_POST['enviar'])) {
    //Obtenemos los datos enviados por POST y los volcamos a variables

    $usuario = filter_input(INPUT_POST, 'usuario', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $password = filter_input(INPUT_POST, 'password');

    //Si el usuario o la contraseña esta vacío, mandamos un mensaje
    if (!is_string($usuario) || !is_string($password)) {
        $error = "Debes introducir un nombre de usuario y una contraseña";
    } else {
        //Conectamos a la base de datos para comenzar las comprobaciones del usuario
        $con = conectar();

        //Creamos la consulta parametrizada para comprobar el usuario y las credenciales, volcadas a la variable
        $sql = "SELECT usuario FROM usuarios WHERE usuario=:login AND contrasena=:contrasena";

        try {
            //preparamos la consulta
            $resultado = $con->prepare($sql);
            //Parametros de la consulta
            $resultado->bindValue(":login", $usuario);
            $resultado->bindValue(":contrasena", hash('sha256', $password));
            //Ejecutamos la consulta
            if ($resultado->execute()) {
                //Volcamos los resultados en un array
                $fila = $resultado->fetch();
            } else
                $error = "Error al ejecutar la consulta.";
        } catch (PDOException $e) {
            $error = "Error en la base de datos al ejecutar la consulta.";
        }

        //Si el numero de filas es distinto de false, es que existe ese usuario
        if (!isset($error)) {
            if ($fila !== false) {
                //Iniciamos la sesion
                session_start();
                //Creamos la variable de usuario con el nombre del usuario
                $_SESSION['usuario'] = $usuario;
                //Redireccionamos a la página que nos interesa
                header("Location: productos.php");
            } else {
                // Si las credenciales no son válidas, se vuelven a pedir
                $error = "Usuario o contraseña no válidos!";
            }
        }
        unset($resultado);
        unset($dwes);
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <title>Ejemplo Tema 3: Login Tienda Web</title>
    <link href="tienda.css" rel="stylesheet" type="text/css">
</head>

<body>
    <div id='login'>
        <form action='login.php' method='post'>
            <fieldset>
                <legend>Login</legend>
                <div><span class='error'>
                        <?php echo (isset($error) ? $error : ""); ?>
                    </span></div>
                <div class='campo'>
                    <label for='usuario'>Usuario:</label><br />
                    <input type='text' name='usuario' id='usuario' maxlength="50" /><br />
                </div>
                <div class='campo'>
                    <label for='password'>Contraseña:</label><br />
                    <input type='password' name='password' id='password' maxlength="50" /><br />
                </div>

                <div class='campo'>
                    <input type='submit' name='enviar' value='Enviar' />
                </div>
            </fieldset>
        </form>
    </div>
</body>

</html>