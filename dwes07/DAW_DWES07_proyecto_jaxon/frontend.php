<?php
require_once __DIR__ . '/setup.php';

use function Jaxon\jaxon;
use function Jaxon\rq;
use function Jaxon\pm;

jaxon()->setOption("js.lib.uri", "jaxon-dist");
jaxon()->setOption('core.request.uri', 'backend.php');

$jaxonCss = jaxon()->getCss();
$jaxonJs = jaxon()->getJs();
$jaxonScript = jaxon()->getScript();

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <title>Ejemplo de uso de JAXON</title>
    <?php echo $jaxonCss ?>
</head>

<body>

    <form onSubmit="jaxon_nuevonumero(jaxon.$('numero').value); return false;">
        Numero:
        <input id="numero" type="text" name="numero">
        <input type="submit" value="Nuevo numero">
    </form>
    <BR>

    <form action="" id="borrarnumero" method="post" onsubmit="return false;"        
        <label for="nuevo"> Número a borrar: <input type="text" id="numeroABorrar"></label>
        <input type="button" value="¡Borrar!">
    </form>
    <script>
        document.querySelector('#borrarnumero input[type=button]').onclick=function()
        {
            <?=rq()->call('borrarnumero',pm()->input('numeroABorrar'))->confirm('¿Seguro que desea borrarlo?');?>
        }
    </script>

    <BR>

    <form id="cambiarnumero" onSubmit="jaxon_cambiarnumero(jaxon.getFormValues('cambiarnumero')); return false;">
        Numero actual:
        <input id="numero_actual" type="text" name="numero_actual"><BR>
        Numero nuevo:
        <input id="numero_nuevo" type="text" name="numero_nuevo"><BR>
        <input type="submit" value="Cambiar un número por otro">
    </form>

    <div id="" style="border:1px solid black; padding:20px; width:300px; margin:50px 0px 0px 100px; text-align: center;">
        <H2>Lista de números</H2>
    </div>
    <div id="listaDeNumeros" style="border:1px solid black; padding:20px; width:300px; margin-left:100px; text-align: center;">
        Lista de números no cargada todavía.
    </div>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <?php echo $jaxonJs ?>

    <?php echo $jaxonScript ?>
    <script>
        jaxon_listarnumeros();
    </script>
</body>

</html>