<?php
require 'conectar.php';
require 'funciones.php';
session_start();

$datos=filter_input(INPUT_POST,'datos', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$check=filter_input(INPUT_POST,'check');
$eliminar=filter_input(INPUT_POST,'eliminar',FILTER_VALIDATE_INT,FILTER_REQUIRE_ARRAY);
$accion=filter_input(INPUT_POST,'accion', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

if ($datos!==null && $datos!==false && isset($_SESSION['check']) && $check==$_SESSION['check'])
{
    $datos=extraeDatos($datos);
    addToSession($datos);
    unset($_SESSION['check']);
}
elseif (is_array($eliminar))
{
    borrarTelefonos($eliminar);  
} 
elseif ($accion==='almacenar')
{    
    $noGuardados=guardarTelefonos($conn);
    $_SESSION['datos']=[];
}
else
{
    echo "Estoy aquí!";
}

?>

<?php if (isset($noGuardados) && !empty($noGuardados)): ?>
No se han podido guardar los siguientes teléfonos:
    <ul>
        <?php array_walk($noGuardados,function ($dato){echo "<LI>$dato</LI>";}); ?>
    </ul>

<?php endif;?>

<form action="" method="post">
<textarea name="datos" id="" cols="30" rows="10"></textarea>
<input type="hidden" name="check" value="<?=$_SESSION['check']=rand(10000,20000)?>">
<input type="submit" value="Enviar!">
</form>

<?php require 'vistas/tabla_telefonos.php'; ?>

<form action="" method="post">
<input type="hidden" name="accion" value="almacenar">
<input type="submit" value="Guardar!">
</form>

