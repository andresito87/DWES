<?php
/* Smarty version 4.3.1, created on 2024-02-14 18:46:41
  from 'C:\xampp\htdocs\proyecto_mvc\templates\bloques\remove_from_fav_form.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_65ccfc81e80d21_69024833',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '19e89e1f5e23a1eabf6dc898aa71e4ae8c59839d' => 
    array (
      0 => 'C:\\xampp\\htdocs\\proyecto_mvc\\templates\\bloques\\remove_from_fav_form.tpl',
      1 => 1682005892,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_65ccfc81e80d21_69024833 (Smarty_Internal_Template $_smarty_tpl) {
?><form action="?accion=removefromfav" method="post">
    <input type="hidden" name="idprod" value="<?php echo $_smarty_tpl->tpl_vars['idprod']->value;?>
">
    <input type="submit" value="Borrar de favoritos">
</form><?php }
}
