<?php
/* Smarty version 5.0.0-rc2, created on 2024-02-18 18:49:59
  from 'file:mostrarErrores.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.0.0-rc2',
  'unifunc' => 'content_65d243477ddd23_75367330',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c7d6f2f3824dc03ff0ae5c890640114f5ebc023e' => 
    array (
      0 => 'mostrarErrores.tpl',
      1 => 1708116227,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_65d243477ddd23_75367330 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\dwes04\\plantillas';
?><div>
    <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('errores'), 'error');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('error')->value) {
$foreach0DoElse = false;
?>
        <h2><?php echo $_smarty_tpl->getValue('error');?>
</h2>
    <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
</div><?php }
}
