<?php
/* Smarty version 4.3.1, created on 2024-02-14 18:46:18
  from 'C:\xampp\htdocs\proyecto_mvc\templates\bloques\notificaciones.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_65ccfc6a8e32a9_79016102',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1c44db4e3936b1151d5e2a62aba08bb10019a491' => 
    array (
      0 => 'C:\\xampp\\htdocs\\proyecto_mvc\\templates\\bloques\\notificaciones.tpl',
      1 => 1682100433,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_65ccfc6a8e32a9_79016102 (Smarty_Internal_Template $_smarty_tpl) {
if ((isset($_smarty_tpl->tpl_vars['notificaciones']->value)) && is_array($_smarty_tpl->tpl_vars['notificaciones']->value) && count($_smarty_tpl->tpl_vars['notificaciones']->value) > 0) {?>
<div class="notificaciones">
<ul>
    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['notificaciones']->value, 'notificacion');
$_smarty_tpl->tpl_vars['notificacion']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['notificacion']->value) {
$_smarty_tpl->tpl_vars['notificacion']->do_else = false;
?>
        <li><?php echo $_smarty_tpl->tpl_vars['notificacion']->value;?>
</li>
    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
</ul>
</div>
<?php }
}
}
