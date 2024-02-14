<?php
/* Smarty version 4.3.1, created on 2024-02-14 18:46:37
  from 'C:\xampp\htdocs\proyecto_mvc\templates\add_to_fav_result.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_65ccfc7da266b8_24930927',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '800704e406943a8c36d058854a8a21ad63b7188b' => 
    array (
      0 => 'C:\\xampp\\htdocs\\proyecto_mvc\\templates\\add_to_fav_result.tpl',
      1 => 1682007509,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.tpl' => 1,
    'file:footer.tpl' => 1,
  ),
),false)) {
function content_65ccfc7da266b8_24930927 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>"Resultado de añadir a favoritos"), 0, false);
echo $_smarty_tpl->tpl_vars['resultado']->value;?>

<?php $_smarty_tpl->_subTemplateRender("file:footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
