<?php
//TAREA 3: +++ Carga de archivos de control de usuarios y sesión
require_once __DIR__.'/session_control.php';
require_once __DIR__.'/src/userauth.php';
//TAREA 3: --- FIN Carga de archivos de control de usuarios y sesión

require_once __DIR__.'/etc/conf.php';
require_once __DIR__.'/src/conn.php';
require_once __DIR__.'/src/dbfuncs.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informe de seguimiento contactado</title>
    <link rel="stylesheet" href="styles/dwes02.css">
</head>
<body>
<?php
        include 'extra/header.php';
?>
<?php
//TAREA 3: +++ Solo COORD y TRASOC pueden acceder a esta sección
if (!(tieneRol(ROL_COORD) || tieneRol(ROL_TRASOC))) {
    echo "<H2>No tiene permisos para realizar esta acción</H2></body></html>";
    exit;
}
//TAREA 3: --- Solo COORD y TRASOC pueden acceder a esta sección

$idseguimiento=filter_input(INPUT_POST,'id_seguimiento',FILTER_VALIDATE_INT);
$informe=filter_input(INPUT_POST,'informe',FILTER_SANITIZE_SPECIAL_CHARS);
$action=filter_input(INPUT_POST,'action',FILTER_SANITIZE_SPECIAL_CHARS);
$usuario_id = filter_input(INPUT_POST, 'idusuario', FILTER_VALIDATE_INT);

?>


<?php if ($action!=="registrarseguimiento" || !$informe): ?>
<form action="" method="post">

<label for="informe">Introduzca el informe de seguimiento:</label>
<textarea name="informe" id="informe" cols="80" rows="10"></textarea>
<br>
<input type="hidden" name="id_seguimiento" value="<?=$idseguimiento?>">
<input type="hidden" name="action" value="registrarseguimiento">
<input type="hidden" name="idusuario" value="<?=$usuario_id?>">
<input type="submit" value="Confirmar contacto y añadir informe">

</form>

<?php else: ?>

        <?php            
            $informe=strip_tags($informe,'<p><strong><b><i><em><u>');
            $pdo=connect();           

            //TAREA 3: +++ Solo se puede rellenar el informe de seguimiento el mismo empleado que lo tiene asignado.
            $r=-100;
            if (comprobarSiSeguimientoEsDeEmpleado($pdo,$idseguimiento,$_SESSION['empleado']['id']))
            {
                $r=registrarcontactoseguimiento($pdo,$idseguimiento,$informe);
            }            
            //TAREA 3: --- FIN Solo se puede rellenar el informe de seguimiento el mismo empleado que lo tiene asignado.
            
            if($r===1):
        ?>
            <h1>Informe registrado adecuadamente</h1>
            <?php if (isset($usuario_id)): ?>
            <form action="detalleusuario.php" method="post">
                    <input type="hidden" name="idusuario" value="<?=$usuario_id?>">
                    <input type="submit" value="Volver a detalles del usuario">
            </form>            
            <?php endif;?>
            <form action="usuarios.php" method="post">                    
                <input type="submit" value="Volver a lista de usuarios">
            </form>
        <?php 
        //TAREA 3: +++ Mostrar mensaje de error de que el empleado no puede rellenar informe de seguimiento de otro empleado
        elseif($r===-100): 
        ?>
            <B>ERROR: solo puede modificar el informe el autor original.</B>
        <?php
        //TAREA 3: --- FIN Mostrar mensaje de error de que el empleado no puede rellenar informe de seguimiento de otro empleado
        else: ?>
            <B>ERROR: no se ha pido realizar la acción.</B>
        <?php endif; ?>
<?php endif; ?>

</body>
</html>