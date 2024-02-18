<?php
/* Smarty version 5.0.0-rc2, created on 2024-02-17 14:29:34
  from 'file:formularioFiltrarDia.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.0.0-rc2',
  'unifunc' => 'content_65d0c2ced557a6_18551772',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a29fd5723eb9267a529dc6da7b6a46133403d670' => 
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
function content_65d0c2ced557a6_18551772 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/var/www/html/dwes04/plantillas';
?><form action="./index.php" method="post">
        <label for="dia_semana">Filtar por día de la semana(lunes - viernes):
                <input type="text" id="dia_semana" name="dia_semana">
        </label>
        <input type="submit" value="Enviar">
</form><?php }
}
