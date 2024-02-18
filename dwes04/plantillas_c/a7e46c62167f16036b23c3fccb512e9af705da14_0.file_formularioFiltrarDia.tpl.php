<?php
/* Smarty version 5.0.0-rc2, created on 2024-02-18 18:55:57
  from 'file:formularioFiltrarDia.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.0.0-rc2',
  'unifunc' => 'content_65d244ad7501b8_46497473',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a7e46c62167f16036b23c3fccb512e9af705da14' => 
    array (
      0 => 'formularioFiltrarDia.tpl',
      1 => 1708180171,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_65d244ad7501b8_46497473 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\dwes04\\plantillas';
?><form action="./index.php" method="post">
        <label for="dia_semana">Filtar por día de la semana(lunes - viernes):
                <input type="text" id="dia_semana" name="dia_semana">
        </label>
        <input type="submit" value="Enviar">
</form><?php }
}
