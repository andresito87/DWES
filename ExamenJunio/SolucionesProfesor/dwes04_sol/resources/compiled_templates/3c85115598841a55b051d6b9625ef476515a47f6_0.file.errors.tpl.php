<?php
/* Smarty version 4.4.1, created on 2024-05-06 11:56:42
  from 'C:\Users\profesorado\OneDrive - iesaguadulce.es\I.E.S. Aguadulce 2023-2024\DWES\UT04\dwes04_sol\resources\templates\errors.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.4.1',
  'unifunc' => 'content_6638a95aa38aa1_27661790',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3c85115598841a55b051d6b9625ef476515a47f6' => 
    array (
      0 => 'C:\\Users\\profesorado\\OneDrive - iesaguadulce.es\\I.E.S. Aguadulce 2023-2024\\DWES\\UT04\\dwes04_sol\\resources\\templates\\errors.tpl',
      1 => 1709229211,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6638a95aa38aa1_27661790 (Smarty_Internal_Template $_smarty_tpl) {
if ((isset($_smarty_tpl->tpl_vars['errores']->value)) && count($_smarty_tpl->tpl_vars['errores']->value) > 0) {?>
    <H2><?php echo htmlspecialchars((string)(($tmp = $_smarty_tpl->tpl_vars['contexto']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);?>
</H2>
    <ul class='errores'>
    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['errores']->value, 'error');
$_smarty_tpl->tpl_vars['error']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['error']->value) {
$_smarty_tpl->tpl_vars['error']->do_else = false;
?>
        <li><?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['error']->value, ENT_QUOTES, 'UTF-8', true);?>
</li>
    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    </ul>
<?php }?>
    
<?php }
}
