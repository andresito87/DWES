<?php
/* Smarty version 5.0.0-rc2, created on 2024-02-18 11:34:06
  from 'file:mostrarErrores.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.0.0-rc2',
  'unifunc' => 'content_65d1eb2e220f52_40092712',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '45c255ca334836a55f9df87aa7b973e439c68b47' => 
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
function content_65d1eb2e220f52_40092712 (\Smarty\Template $_smarty_tpl) {
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
