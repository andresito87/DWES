<?php
require_once './src/userauth.php';
require_once './etc/conf.php';
$mensaje = require 'session_control.php';

$mostrar_formulario_login = true;
$mostrar_aviso_usuario_autenticado = false;
if (isset($_SESSION['dni'])) {
    $mostrar_formulario_login = false;
    $mostrar_aviso_usuario_autenticado = true;
}

if ($mostrar_aviso_usuario_autenticado) {
    echo $mensaje;
}

// Comprobamos si ya se ha enviado el formulario
if (isset($_POST['enviar']) && !isset($_SESSION['dni'])) {
    //Obtenemos los datos enviados por POST y los volcamos a variables

    $dni = filter_input(INPUT_POST, 'dni', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $password = filter_input(INPUT_POST, 'password');

    //Si el dni o la password esta vacío, mandamos un mensaje
    if (empty($dni) || empty($password)) {
        $error = "Debes introducir un dni y una contraseña";
    } else {
        $es_contraseña_valida = verificacion_contrasena($dni, $password);

        //Si el numero de filas es distinto de false, es que existe ese usuario
        if ($es_contraseña_valida) {
            //Creamos la variable de usuario con el nombre del usuario
            $_SESSION['dni'] = [$es_contraseña_valida['id'], $es_contraseña_valida['dni'], $es_contraseña_valida['nombre'], $es_contraseña_valida['apellidos'], $es_contraseña_valida['roles']];
            //no mostramos el formulario de login
            $mostrar_formulario_login = false;
        } else {
            // Si las credenciales no son válidas, se muestra un mensaje de error
            $error = "DNI o contraseña no válidos!";
        }
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <title>Formulario de Login</title>
    <link href="./styles/estilosLogin.css" rel="stylesheet" type="text/css">
</head>

<body>
    <?php
    if ($mostrar_formulario_login) {
        ?>
        <h1>Formulario de login</h1>
        <div id='login'>
            <form action='login.php' method='post'>
                <fieldset>
                    <div><span class='error'>
                            <?php echo (isset($error) ? $error : ""); ?>
                        </span></div>
                    <div class='campo'>
                        <label for='dni'>DNI:</label><br />
                        <input type='text' name='dni' id='dni' maxlength="50" /><br />
                    </div>
                    <div class='campo'>
                        <label for='password'>Password:</label><br />
                        <input type='password' name='password' id='password' maxlength="50" /><br />
                    </div>

                    <div class='campo'>
                        <input type='submit' name='enviar' value='¡Entrar!' />
                    </div>
                </fieldset>
            </form>
        </div>
        <?php
    } else {
        //Guardamos en la sesión la fecha y hora del login satisfactorio
        $_SESSION['ultimo_acceso'] = time();

        //Mostramos el mensaje de bienvenida
        echo '<div id="bienvenida">';
        // El usuario habria filtrado la lista de usuarios, antes de intentar 
        //loguearse de nuevo. Por tanto, borramos el filtro
        if (isset($_SESSION['filtro'])) {
            unset($_SESSION['filtro']);
        }
        echo 'Bienvenido, ' . $_SESSION["dni"][2] . " " . $_SESSION["dni"][3] . '. Haz clic aquí para <a href="./usuarios.php">ver los usuarios</a>.';
        echo '</div>';
    }
    ?>
</body>

</html>