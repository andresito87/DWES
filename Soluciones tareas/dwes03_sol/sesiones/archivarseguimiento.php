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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Archivar seguimiento</title>
    <link rel="stylesheet" href="styles/dwes02.css">
</head>
<body>

<?php
        include 'extra/header.php';
?>

<?php
//TAREA 3: +++ Solo el coordinador o la coordinadora puede archivar seguimientos
if (!tieneRol(ROL_COORD)) {
    echo "<H1>No tiene permisos para realizar esta operación</H1></body></html>";
    exit;
}
//TAREA 3: --- FIN Solo el coordinador o la coordinadora puede archivar seguimientos

$idseguimiento=filter_input(INPUT_POST,'idseguimiento',FILTER_VALIDATE_INT);
$idusuario = filter_input(INPUT_POST, 'idusuario', FILTER_VALIDATE_INT);
$confirmado = filter_input(INPUT_POST, 'confirmado',FILTER_SANITIZE_SPECIAL_CHARS);
$enviado = filter_input(INPUT_POST, 'enviado',FILTER_SANITIZE_SPECIAL_CHARS);
?>


    <?php if(!isset($enviado)): ?>
        <form action="" method="post">
            <label>Marca la siguiente casilla para confirmar la operación de archivado 
            <input type="checkbox" name="confirmado" value="SI"></label>
            <input type="hidden" name="enviado" value="SI"></label>
            <input type="submit" value="ARCHIVAR">            
            <input type="hidden" name="idseguimiento" value="<?= $idseguimiento ?>">
            <input type="hidden" name="idusuario" value="<?=$idusuario?>">

        </form>
    <?php elseif($confirmado==='SI' && $enviado==='SI'):?>

            <?php
            if ($idseguimiento):
                    $pdo=connect();
                    $r=archivarseguimiento($pdo,$idseguimiento);                    
                    if($r>0)
                    {
                        echo '<H3 style="text-align:center">Seguimiento archivado</H3>';
                    }        
                    else
                    {
                        echo '<H3 style="text-align:center">No se ha podido archivar el seguimiento. Posiblemente ya estaba archivado.</H3>';
                    }
            else: ?>
                <H3 style="text-align:center">Datos necesarios no recibidos.</H3>
            <?php endif; ?>
    <?php else: ?>
        <H3 style="text-align:center">Archivado NO realizado.</H3> 
    <?php endif; ?>
            <?php if($idusuario):?>
            <form action="detalleusuario.php" method="post">
                <input type="hidden" name="idusuario" value="<?=$idusuario?>">
                <input type="submit" value="Volver a detalles del usuario">
            </form>
            <?php endif;?>
            <form action="usuarios.php" method="post">                    
                <input type="submit" value="Volver a lista de usuarios">
            </form>
    
</body>
</html>