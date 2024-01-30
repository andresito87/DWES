<?php
//TAREA 3: +++ Carga de archivos de control de usuarios y sesión
require_once __DIR__.'/session_control.php';
require_once __DIR__.'/src/userauth.php';
//TAREA 3: --- FIN Carga de archivos de control de usuarios y sesión

require_once __DIR__.'/etc/conf.php';
require_once __DIR__.'/src/conn.php';
require_once __DIR__.'/src/dbfuncs.php';
require_once __DIR__.'/extra/utils.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de usuarios</title>
    <link rel="stylesheet" href="styles/dwes02.css">

</head>
<body>
<?php
        include 'extra/header.php';
?>

<?php
//TAREA 3: +++ Control de rol (SOLO COORDINADOR Y TRABAJADOR SOCIAL)
if (!tieneRol(ROL_COORD) && !tieneRol(ROL_TRASOC)) {    
    echo "<H2> No tiene permisos para realizar esta acción </H2></body></html>";
    exit;
}
//TAREA 3: --- FIN Control de rol (SOLO COORDINADOR Y TRABAJADOR SOCIAL)


//TAREA 3: +++ Solo ROL_COORD puede usar un id de usuario de cualquier TRASOC o COORD
if (tieneRol(ROL_COORD))
{
    $datos['empleado_id'] = filter_input(INPUT_POST, 'empleado', FILTER_VALIDATE_INT);
    if (!$datos['empleado_id'])
        $errors[]="El id de empleado no se ha proporcionado o no es correcto";
}
else
    $datos['empleado_id']=$_SESSION['empleado']['id'];
//TAREA 3: --- Solo ROL_COORD puede usar un id de usuario de cualquier TRASOC o COORD

$datos['usuario_id'] = filter_input(INPUT_POST, 'idusuario', FILTER_VALIDATE_INT);
if (!$datos['usuario_id'])
    $errors[]="El id de usuario no se ha proporcionado o no es correcto";

$datos['fecha_espanol'] = filter_input(INPUT_POST, 'fecha', FILTER_VALIDATE_REGEXP,REGEX_VALIDATE_FECHA);
if ($datos['fecha_espanol'])
    $datos['fecha_mysql'] = convertirFechaAMySQL($datos['fecha_espanol']);
else
    $errors[]="La fecha de seguimiento no es correcta (no sigue el formato dd/mm/aaaa)";
 
$datos['hora'] = filter_input(INPUT_POST, 'hora', FILTER_VALIDATE_REGEXP, REGEX_VALIDATE_HORA);
if(!$datos['hora']) 
    $errors[]="La hora de seguimiento no es correcta (no sigue el formato hh:mm)";

$datos['medio'] = filter_input(INPUT_POST, 'medio_contacto', FILTER_VALIDATE_REGEXP,REGEX_VALIDATE_CONTACTO);
if (!$datos['medio'])
    $errors[]="El medio de contacto no es correcto no se ha especificado.";

$datos['otro'] = ($datos['medio'])? filter_input(INPUT_POST, 'otro', FILTER_SANITIZE_SPECIAL_CHARS):null;
if ($datos['medio']==='OTRO' && ! $datos['otro'])
    $errors[]="El medio de contacto es OTRO pero no se ha descrito.";

?>

<?php
if (isset($errors))
{
    echo "<H1>Corrija los errores para continuar</H1>";
    include 'extra/mostrarerrores.php';
    $pdo=connect();
    $detalle_usuario=detalle($pdo,id:$datos['usuario_id']);
    
    //TAREA 3: +++ Mostrar lista empleados solo para COORDINADOR
    if (tieneRol(ROL_COORD)) $empleados=listarEmpleadosSeguimiento($pdo);
    //TAREA 3: --- FIN Mostrar lista empleados solo para COORDINADOR

    include 'extra/formseguimiento.php';
}
else
{
    $datos['fechahora']=$datos['fecha_mysql'].' '.$datos['hora'];
    $pdo=connect();
    switch(insertarSeguimiento($pdo,$datos)){
        case 1:
            echo <<<ENDBLOCK
                <H1>Seguimiento insertado adecuadamente</H1>
                <form action="detalleusuario.php" method="post">
                    <input type="hidden" name="idusuario" value="{$datos['usuario_id'] }">
                    <input type="submit" value="Volver a detalles del usuario">
                </form>
                <form action="usuarios.php" method="post">                    
                    <input type="submit" value="Volver a lista de usuarios">
                </form>
            ENDBLOCK;            
            break;
        default:
        echo <<<ENDBLOCK
            <H1>Seguimiento insertado no insertado.</H1>
            <form action="detalleusuario.php" method="post">
                <input type="hidden" name="idusuario" value="{$datos['usuario_id'] }">
                <input type="submit" value="Volver a detalles del usuario">
            </form>
            <form action="usuarios.php" method="post">                    
                <input type="submit" value="Volver a lista de usuarios">
            </form>
        ENDBLOCK;            
        break;        
    }
    
}
?>
</body>
</html>