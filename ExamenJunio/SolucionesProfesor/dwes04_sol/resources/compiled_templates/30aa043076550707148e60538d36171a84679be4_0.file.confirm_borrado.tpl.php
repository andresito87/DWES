<?php
/* Smarty version 4.4.1, created on 2024-05-15 15:22:54
  from 'C:\xampp\htdocs\ExamenJunio\SolucionesProfesor\dwes04_sol\resources\templates\confirm_borrado.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.4.1',
  'unifunc' => 'content_6644b72e3857f9_14973391',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '30aa043076550707148e60538d36171a84679be4' => 
    array (
      0 => 'C:\\xampp\\htdocs\\ExamenJunio\\SolucionesProfesor\\dwes04_sol\\resources\\templates\\confirm_borrado.tpl',
      1 => 1709229461,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:errors.tpl' => 1,
  ),
),false)) {
function content_6644b72e3857f9_14973391 (Smarty_Internal_Template $_smarty_tpl) {
if ((isset($_smarty_tpl->tpl_vars['errores']->value))) {?>
    <?php $_smarty_tpl->_subTemplateRender('file:errors.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('contexto'=>'Errores al crear el taller','errores'=>$_smarty_tpl->tpl_vars['errores']->value), 0, false);
}?>
<form action="?accion=borrar_taller" method="post">
    <label> 
        <input type="checkbox" name="confirmacion" 
               value="si">
        Marca la casilla para confirmar el borrado.
    </label><BR>    
    <input type="hidden" name="id_taller" value="<?php echo $_smarty_tpl->tpl_vars['id_taller']->value;?>
"> 
    <input type="hidden" name="step" value="confirm"> 
    <input type="submit" value="Enviar!">
</form><?php }
}
