<?php
/* Smarty version 5.0.0-rc2, created on 2024-02-17 13:04:08
  from 'file:errores.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.0.0-rc2',
  'unifunc' => 'content_65d0aec81558b6_28921172',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c9e3bb8e234da51be693e0aa02e47de724f12191' => 
    array (
      0 => 'errores.tpl',
      1 => 1708116227,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_65d0aec81558b6_28921172 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/var/www/html/dwes04/plantillas';
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
