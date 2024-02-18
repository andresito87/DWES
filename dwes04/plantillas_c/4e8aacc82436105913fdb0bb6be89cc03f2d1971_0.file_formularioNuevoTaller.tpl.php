<?php
/* Smarty version 5.0.0-rc2, created on 2024-02-18 18:56:15
  from 'file:formularioNuevoTaller.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.0.0-rc2',
  'unifunc' => 'content_65d244bfcd9418_63077803',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4e8aacc82436105913fdb0bb6be89cc03f2d1971' => 
    array (
      0 => 'formularioNuevoTaller.tpl',
      1 => 1708256895,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_65d244bfcd9418_63077803 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\dwes04\\plantillas';
?><style>
    h1 {
        text-align: center;
    }

    form {
        display: flex;
        flex-direction: column;
        align-items: center;
        font-size: large;
        font-weight: bold;
    }

    input,
    select {
        margin: 10px;
        padding: 5px;
    }

    input[type="submit"] {
        margin: 20px;
        padding: 10px;
        background-color: #4CAF50;
        color: white;
        border: none;
        font-size: x-large;
        border-radius: 5px;
        cursor: pointer;
    }

    input[type="submit"]:hover {
        background-color: #45a049;
    }
</style>
<div>
    <!--  Aunque los datos son verificados del lado del servidor, añado una sutíl comprobación con el atributo required en HTML   -->
    <h1>Ingrese los datos del nuevo taller</h1>
    <form action="index.php?accion=crear_taller" method="post">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" required>
        <br>
        <label for="descripcion">Descripción:</label>
        <input type="text" name="descripcion" id="descripcion" required>
        <br>
        <label for="ubicacion">Ubicación:</label>
        <input type="text" name="ubicacion" id="ubicacion" required>
        <br>
        <label for="dia_semana">Día de la semana:</label>
        <select name="dia_semana" id="dia_semana" required>
            <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('dias_validos'), 'dia');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('dia')->value) {
$foreach0DoElse = false;
?>
                <option value="<?php echo $_smarty_tpl->getValue('dia');?>
" <?php if ($_smarty_tpl->getValue('dia') == $_smarty_tpl->getValue('dia_actual')) {?>selected<?php }?>><?php echo $_smarty_tpl->getValue('dia');?>
</option>
            <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
        </select>
        <br>
        <label for="hora_inicio">Hora de Inicio:</label>
        <input type="time" name="hora_inicio" id="hora_inicio" required>
        <br>
        <label for="hora_fin">Hora de Fin:</label>
        <input type="time" name="hora_fin" id="hora_fin" required>
        <br>
        <label for="cupo_maximo">Cupo Máximo:</label>
        <input type="number" name="cupo_maximo" id="cupo_maximo" required>
        <br>
        <input type="submit" value="Guardar">
    </form>
</div><?php }
}
