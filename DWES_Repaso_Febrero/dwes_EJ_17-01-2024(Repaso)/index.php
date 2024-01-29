<?php
require 'conf.php';
require 'funciones.php';

session_start();




$inicio=filter_input(INPUT_POST,'inicio',FILTER_VALIDATE_INT);
$inicio=$inicio?$inicio:($_SESSION['inicio']??0);
$_SESSION['inicio']=$inicio;

$orden=filter_input(INPUT_POST,'orden');
$orden=$orden?$orden:($_SESSION['orden']??null);
$_SESSION['orden']=$orden;

$categoria=filter_input(INPUT_POST,'categoria');
$categoria=$categoria?$categoria:($_SESSION['categoria']??null);
$_SESSION['categoria']=$categoria;


if (!is_int($inicio)) $inicio=0;
$datos=cargarCSV('productos.csv'); 

if ($orden) $datos=ordenar($datos,$orden);

if ($categoria) $datos=filtrar($datos,$categoria);

$t=subconjunto($datos,$inicio,ELEM_PAG);

var_dump($t);
?>
<?php if ($inicio-ELEM_PAG>=0):?>
<form action="" method="post">
<input type="hidden" name="orden" value="<?=$orden?>" id=""><BR>
<input type="hidden" name="categoria" value="<?=$categoria?>" id=""><BR>
<input type="hidden" name="inicio" value="<?=$inicio-ELEM_PAG?>">
<input type="submit" value="Ver los <?=ELEM_PAG?> anteriores">
</form>
<?php endif?>
<br>
<?php if ($inicio+ELEM_PAG<count($datos)):?>
<form action="" method="post">
<input type="hidden" name="orden" value="<?=$orden?>" id=""><BR>
<input type="hidden" name="categoria" value="<?=$categoria?>" id=""><BR>
<input type="hidden" name="inicio" value="<?=$inicio+ELEM_PAG?>">
<input type="submit" value="Ver los <?=ELEM_PAG?> siguientes">
</form>
<?php endif?>

<form action="" method="post">
Columna Orden: <input type="text" name="orden" value="<?=$orden?>" id=""><BR>
Categoría: <input type="text" name="categoria" value="<?=$categoria?>" id=""><BR>
<input type="hidden" name="inicio" value="<?=$inicio?>">
<input type="submit" value="Enviar!">
</form>