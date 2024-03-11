<?php
/* Smarty version 4.4.1, created on 2024-03-11 19:28:29
  from 'C:\xampp\htdocs\dwes04_ejemplo_impresoras\templates\impresoras.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.4.1',
  'unifunc' => 'content_65ef4d4d2f7023_25080963',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b0f9cc5ca0672432bcfd6c95402e9eb801966ddb' => 
    array (
      0 => 'C:\\xampp\\htdocs\\dwes04_ejemplo_impresoras\\templates\\impresoras.tpl',
      1 => 1710181405,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_65ef4d4d2f7023_25080963 (Smarty_Internal_Template $_smarty_tpl) {
?><H1>Listado de impresoras</H1>
<table>
<tr>
<th>ID</th>
<th>Marca</th>
<th>Modelo</th>
<th>Tipo</th>
</tr>
<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['impresoras']->value, 'impresora');
$_smarty_tpl->tpl_vars['impresora']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['impresora']->value) {
$_smarty_tpl->tpl_vars['impresora']->do_else = false;
?>
    <tr>
        <td><?php echo $_smarty_tpl->tpl_vars['impresora']->value->id;?>
</td>
        <td><?php echo $_smarty_tpl->tpl_vars['impresora']->value->marca;?>
</td>
        <td><?php echo $_smarty_tpl->tpl_vars['impresora']->value->modelo;?>
</td>
        <td><?php echo $_smarty_tpl->tpl_vars['impresora']->value->tipo;?>
</td>
    </tr>
<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
</table>
<a href="index.php?accion=form_crear_impresora">Crear Impresora</A><?php }
}
