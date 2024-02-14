<?php
/* Smarty version 4.3.1, created on 2024-02-14 18:46:43
  from 'C:\xampp\htdocs\proyecto_mvc\templates\remove_from_fav_result.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_65ccfc83c35b11_44452028',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2d550ac5a7feaf6020bdc985e6aaa7307b5152c1' => 
    array (
      0 => 'C:\\xampp\\htdocs\\proyecto_mvc\\templates\\remove_from_fav_result.tpl',
      1 => 1682007552,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.tpl' => 1,
    'file:footer.tpl' => 1,
  ),
),false)) {
function content_65ccfc83c35b11_44452028 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>"Resultado de eliminar de favoritos"), 0, false);
echo $_smarty_tpl->tpl_vars['resultado']->value;?>

<?php $_smarty_tpl->_subTemplateRender("file:footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
