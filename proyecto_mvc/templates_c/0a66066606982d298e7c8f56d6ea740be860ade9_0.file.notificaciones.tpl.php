<?php
/* Smarty version 4.3.1, created on 2023-04-21 18:17:42
  from 'G:\onedrive\OneDrive - iesaguadulce.es\Mejoras DWES\UT04\proyecto_mvc\templates\bloques\notificaciones.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_6442d346060209_50431307',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0a66066606982d298e7c8f56d6ea740be860ade9' => 
    array (
      0 => 'G:\\onedrive\\OneDrive - iesaguadulce.es\\Mejoras DWES\\UT04\\proyecto_mvc\\templates\\bloques\\notificaciones.tpl',
      1 => 1682100433,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6442d346060209_50431307 (Smarty_Internal_Template $_smarty_tpl) {
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