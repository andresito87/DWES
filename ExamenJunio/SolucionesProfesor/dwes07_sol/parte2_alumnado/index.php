<?php
require_once __DIR__.'/setup.php';

use DWES07\model\Ubicacion;

$jaxonCss = $jaxon->getCss();
$jaxonJs = $jaxon->getJs();
$jaxonScript = $jaxon->getScript();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Listar e incrementar stock de productos.</title>
    <?php echo $jaxonCss ?>
        <style>
            table {
                border-collapse: collapse;
                margin: 25px 0;
                font-size: 0.9em;
                font-family: sans-serif;
                min-width: 400px;
                box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
            }
            table thead tr {
                background-color: #009879;
                color: #ffffff;
                text-align: left;
            }
            table th,
            table td {
                padding: 12px 15px;
            }
            .formblock {
                margin:10px;
                padding:10px;
                border:1px solid blue;
            }
            #log {
                background-color: beige;
                border: 1px solid black;
                padding:10px;
                margin:5px;
                border-radius: 10px;
            }
        </style>
</head>
<body>
<div id="formulario_autenticacion" style="display:none" class="formblock">

<form id="login" onSubmit="return false;">
    <label>DNI: <input type="text" name="usuario" id="login_dni"></label><BR>
    <label>Password: <input type="password" name="password" id="login_password"></label><BR>
    <input type="button"
        onclick="<?=rq()->call("login",pm()->input('login_dni'),pm()->input('login_password'));?>"
        value="Login!">
</form>

</div>

<div id="area_autenticada" style="display:none">

<input type="button" onclick="<?=rq()->call('logout')?>" value="¡Salir!">

<div id="listaUbicaciones">
    //GENERAR AQUÍ LISTA DE UBICACIONES
</div>

<input type="button" value="Actualizar lista de ubicaciones" onclick="alert('Invocar aquí la operación JAXON-JS para actualizar la lista de ubicaciones')";>

<br>
<br>

<form id="nuevaUbicacion" onSubmit="return false;">
    <label> Nombre:<input id="nombre" type="text" name="nombre"></label>
    <BR>
    <label> Descripcion:<input id="descripcion" type="text" name="descripcion"></label>
    <BR>
    <label> Días:
        <?php foreach(Ubicacion::DIAS as $dia): ?>
            <input type="checkbox" name="dias[]" value="<?=$dia?>"> <?=$dia?>
        <?php endforeach; ?>
    </label>
    <br>
    <input type="button"
        onclick="alert('Invocar aquí la operación JAXON-JS para crear la ubicacion')";
    value="Crear nueva ubicación.">
</form>

<BR>
</div>
<div id='log'>
    <H1>Mensajes de LOG:</H1>
</div>

<?php echo $jaxonJs ?>

<?php echo $jaxonScript ?>

<script>    
    <?= rq()->call('establecerInterfaz'); ?>
</script>

</body>
</html>
