<?php
/* Smarty version 4.3.1, created on 2024-02-14 18:46:32
  from 'C:\xampp\htdocs\proyecto_mvc\templates\bloques\add_to_fav_form.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_65ccfc7854d328_63207545',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '53a8788c393784d5996dcd28416a4bef4da3a83b' => 
    array (
      0 => 'C:\\xampp\\htdocs\\proyecto_mvc\\templates\\bloques\\add_to_fav_form.tpl',
      1 => 1682003686,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_65ccfc7854d328_63207545 (Smarty_Internal_Template $_smarty_tpl) {
?><form action="?accion=addtofav" method="post">
    <input type="hidden" name="idprod" value="<?php echo $_smarty_tpl->tpl_vars['idprod']->value;?>
">
    <input type="submit" value="Añadir a favoritos">
</form><?php }
}
