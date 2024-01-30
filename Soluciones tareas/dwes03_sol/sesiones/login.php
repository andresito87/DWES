<?php

require_once __DIR__.'/etc/conf.php';
require_once __DIR__.'/src/conn.php';
require_once __DIR__.'/src/userauth.php';

define('DO_NOT_REDIRECT',1);
require_once __DIR__.'/session_control.php';

if (!isset($_SESSION['empleado']))
{
    $dni=filter_input(INPUT_POST,'dni',FILTER_SANITIZE_SPECIAL_CHARS);
    $password=filter_input(INPUT_POST,'password'); //Aquí no se debe aplicar filtrado
    $pdo=connect();
    if ($dni!==null && $password!==null)
    {
        $datosEmpleado=verificarEmpleado($pdo,$dni,$password);
        if ($datosEmpleado===false || $datosEmpleado===-1)
        {
            $error="No se pudo autenticar al empleado. ¿Se ha configurado el archivo conf.php?";
        }
        elseif (is_array($datosEmpleado))
        {
            $_SESSION['timestamp']=time();
            $_SESSION['empleado']=$datosEmpleado;
        }
        else
        {
            $errores[]="Password o dni incorrecto.";            
        }
    }    
}
else
{
    $resultados[]="El empleado ya se está autenticado.";
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Empleados Asociación Respira</title>
</head>
<body>

<?php include __DIR__.'/extra/resultados.php'; ?>
<?php include __DIR__.'/extra/mostrarerrores.php'; ?>

<?php if (!isset($_SESSION['empleado'])) : ?>

<H1> Formulario de login </H1>    
<?php if (isset($error)): ?>
    <h3><?=$error?></h3>
<?php endif; ?>
<form action="" method="post">
    <label for="dni">DNI: <input type="text" name="dni" id="dni"></label><br>
    <label for="password">Password: <input type="password" name="password" id="password"></label><br>
    <input type='submit' value='¡Entrar!'>
</form>

<?php else: ?>

Bienvenido, <?=$_SESSION['empleado']['nombre']?> <?=$_SESSION['empleado']['apellidos']?>. Haga clic aquí para <a href="usuarios.php">ver los usuarios</a>.


<?php endif; ?>

    
</body>
</html>