<?php
/* Smarty version 4.3.1, created on 2024-02-14 18:46:41
  from 'C:\xampp\htdocs\proyecto_mvc\templates\lista_de_favoritos.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_65ccfc81e6fdb1_75672069',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '28bd88514907f35cf0f4b9b2c0c419baac24ff15' => 
    array (
      0 => 'C:\\xampp\\htdocs\\proyecto_mvc\\templates\\lista_de_favoritos.tpl',
      1 => 1682102545,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.tpl' => 1,
    'file:bloques/remove_from_fav_form.tpl' => 1,
    'file:footer.tpl' => 1,
  ),
),false)) {
function content_65ccfc81e6fdb1_75672069 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>"Lista de favoritos",'exclude'=>"listfavs"), 0, false);
?>
<H2>Esta es tu lista de productos favoritos</H2>
<table border="1px solid blue">
    <thead>
        <tr>
            <th>ID</th>            
            <th>Codigo</th>
            <th>Descripción</th>
            <th>Precio</th>            
            <th>Operaciones</th>
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
                <?php $_smarty_tpl->_subTemplateRender("file:bloques/remove_from_fav_form.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('idprod'=>$_smarty_tpl->tpl_vars['producto']->value->getId()), 0, true);
?>
            </td>            
        </tr>
        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    </tbody>
</table>
<?php $_smarty_tpl->_subTemplateRender("file:footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
