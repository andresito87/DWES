<?php
/* Smarty version 4.3.1, created on 2024-02-06 13:10:32
  from 'C:\xampp\htdocs\DWES04_proyecto_mvc_productos_favoritos\proyecto_mvc\templates\default.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_65c221b89ed0e2_70196195',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd73cdd3b187a7a1bf1c5888a72310ecc7ab53313' => 
    array (
      0 => 'C:\\xampp\\htdocs\\DWES04_proyecto_mvc_productos_favoritos\\proyecto_mvc\\templates\\default.tpl',
      1 => 1682102367,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.tpl' => 1,
    'file:bloques/add_to_fav_form.tpl' => 1,
    'file:footer.tpl' => 1,
  ),
),false)) {
function content_65c221b89ed0e2_70196195 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>"Página de inicio",'exclude'=>"principal"), 0, false);
$_smarty_tpl->_assignInScope('logged', (isset($_SESSION['usuario'])));?>    

<table border="1px solid blue">
    <thead>
        <tr>
            <th>Id</th>
            <th>Codigo</th>
            <th>Descripción</th>
            <th>Precio</th>
            <th>Stock</th>     
            <?php if ($_smarty_tpl->tpl_vars['logged']->value) {?>            
                 <th>Operaciones</th>
            <?php }?>
        </tr>
    </thead>
    <tbody>
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['productos']->value, 'producto');
$_smarty_tpl->tpl_vars['producto']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['producto']->value) {
$_smarty_tpl->tpl_vars['producto']->do_else = false;
?>
        <tr>
            <td>
                <?php echo $_smarty_tpl->tpl_vars['producto']->value->getId();?>

            </td>
            <td>
                <?php echo $_smarty_tpl->tpl_vars['producto']->value->getCod();?>

            </td>
            <td>
                <?php echo $_smarty_tpl->tpl_vars['producto']->value->getDescripcion();?>

            </td>
            <td>
                <?php echo $_smarty_tpl->tpl_vars['producto']->value->getPrecio();?>

            </td>
            <td>
                <?php echo $_smarty_tpl->tpl_vars['producto']->value->getStock();?>

            </td>
            <?php if ($_smarty_tpl->tpl_vars['logged']->value) {?>            
            <td>
                <?php $_smarty_tpl->_subTemplateRender("file:bloques/add_to_fav_form.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('idprod'=>$_smarty_tpl->tpl_vars['producto']->value->getId()), 0, true);
?>
            </td>
            <?php }?>
        </tr>
        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    </tbody>
    <tfoot>
    <tr>
    <td <?php if ($_smarty_tpl->tpl_vars['logged']->value) {?> colspan="6" <?php } else { ?> colspan="5" <?php }?> style="text-align:center">

    </td>
    </tr>
    </tfoot>
</table>
<?php $_smarty_tpl->_subTemplateRender("file:footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}