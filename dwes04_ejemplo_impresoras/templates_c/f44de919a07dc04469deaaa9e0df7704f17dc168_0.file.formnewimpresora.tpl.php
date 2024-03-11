<?php
/* Smarty version 4.4.1, created on 2024-03-11 19:28:32
  from 'C:\xampp\htdocs\dwes04_ejemplo_impresoras\templates\formnewimpresora.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.4.1',
  'unifunc' => 'content_65ef4d50237a59_82690140',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f44de919a07dc04469deaaa9e0df7704f17dc168' => 
    array (
      0 => 'C:\\xampp\\htdocs\\dwes04_ejemplo_impresoras\\templates\\formnewimpresora.tpl',
      1 => 1710181405,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_65ef4d50237a59_82690140 (Smarty_Internal_Template $_smarty_tpl) {
if ((isset($_smarty_tpl->tpl_vars['errors']->value))) {?>
    <div style="color: red;">
        <ul>
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['errors']->value, 'error');
$_smarty_tpl->tpl_vars['error']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['error']->value) {
$_smarty_tpl->tpl_vars['error']->do_else = false;
?>
                <li><?php echo $_smarty_tpl->tpl_vars['error']->value;?>
</li>
            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        </ul>
    </div>
<?php }?>
<form method="post" action="?accion=guardar_impresora">
    <label for="marca">Marca:</label>
    <input type="text" id="marca" name="marca" ><br>

    <label for="modelo">Modelo:</label>
    <input type="text" id="modelo" name="modelo" ><br>

    <label for="tipo">Tipo:</label>
    <select name="tipo" id="tipo">
        <option value="inyección de tinta" >Inyección de tinta</option>
        <option value="laser">Laser</option>
        <option value="matricial">Matricial</option>
    </select><br>
    
    <label for="color">Color:</label>
    <input type="radio" name="color" value="si"> Si
    <input type="radio" name="color" value="no"> No<br>
    
    <label for="year">Año:</label>
    <input type="text" id="year" name="year"><br>

    <label for="coste">Precio:</label>
    <input type="text" id="coste" name="coste"><br>

    <input type="submit" value="Guardar">
</form><?php }
}
