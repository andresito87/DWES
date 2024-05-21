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
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
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
            button {
                background-color: #009879;
                color: white;
                border: none;
                padding: 10px 20px;
                border-radius: 4px;
                cursor: pointer;
                margin: 5px;
            }
        </style>
</head>
<body>
<div id="formulario_autenticacion" style="display:none" class="formblock">

<form id="login" onSubmit="return false;">
    <label>DNI: <input type="text" name="usuario" id="login_dni"></label><BR>
    <label>Password: <input type="password" name="password" id="login_password"></label><BR>
    <input type="button"
        onclick="<?=rq()->call('login',pm()->input('login_dni'),pm()->input('login_password'));?>"
        value="Login!">
</form>

</div>

<div id="area_autenticada" style="display:none">

<input type="button" onclick="<?=rq()->call('logout')?>" value="¡Salir!">

<div id="listaUbicaciones">
    <!-- Aquí se mostrará la lista de ubicaciones -->
</div>

<input type="button" value="Actualizar lista de ubicaciones" onclick="<?=rq()->call('establecerInterfaz')?>";>

<br>
<br>

<form id="nuevaUbicacion" onSubmit="return false;">
    <input type="hidden" name="id" id="id">
    <label> Nombre:<input id="nombre" type="text" name="nombre"></label>
    <BR>
    <label> Descripcion:<input id="descripcion" type="text" name="descripcion"></label>
    <BR>
    <label> Días: </label>
        <?php foreach(Ubicacion::DIAS as $dia):?>
            <input id="<?=$dia?>" type="checkbox" name="dias[]" value="<?=$dia?>"> <?=$dia?>
        <?php endforeach; ?>
   
    <br>
    <input type="button"
        onclick="<?=rq()->call('crearUbicacion',pm()->input('id'),pm()->form('nuevaUbicacion'));?>"
    value="Crear nueva ubicación">
    <input type="button"
        onclick="<?=rq()->call('modificarUbicacion',pm()->input('id'),pm()->form('nuevaUbicacion'));?>"
    value="Guardar Datos Modificados">
    <input type="button"
        onclick="<?=rq()->call('limpiarDatosFormulario');?>"
    value="Limpiar formulario">
</form>

<BR>
</div>
<div id='log'>
    <h1>Mensajes de LOG:</h1>
</div>

<?php echo $jaxonJs ?>

<?php echo $jaxonScript ?>

<script>
    if(localStorage.getItem("contenidoLog") ==""){
        document.getElementById("log").innerHTML="<h1>Mensajes de LOG:</h1>"+localStorage.getItem("contenidoLog");
    }else{
        document.getElementById("log").innerHTML=localStorage.getItem("contenidoLog");
    }
    <?=rq()->call('establecerInterfaz');?>
</script>

</body>
</html>
