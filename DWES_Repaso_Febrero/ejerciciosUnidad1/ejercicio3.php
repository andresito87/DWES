<?php
/*Implementa un sistema simple de login sin usar sesiones en PHP*/

require_once('funcionesEjer3Login.php');
$logueado = false;
if (isset($_POST['enviar']) && $_POST['enviar'] == 'Enviar') {
    if (isset($_POST['usuario']) && isset($_POST['password'])) {
        $usuario = $_POST['usuario'];
        $password = $_POST['password'];
        $con = connect();
        $contrasenaRecuperada = obtenerContrasena($con, $usuario);
        if (is_array($contrasenaRecuperada) && $usuario == $contrasenaRecuperada['nombre'] && $password == $contrasenaRecuperada['contrasena']) {
            echo "Bienvenido $usuario";
            $logueado = true;
        } else {
            echo "Usuario o contraseña incorrectos";
        }
    } else {
        echo "No se ha enviado nada";
    }
}
?>

<? if (!$logueado): ?>
    <h1>Login:</h1>

    <form action="" method="post">
        <label for="usuario">Usuario</label>
        <input type="text" name="usuario" id="usuario">
        <label for="password">Contraseña</label>
        <input type="password" name="password" id="password">
        <input type="submit" name="enviar" value="Enviar">
    </form>
<? endif; ?>

