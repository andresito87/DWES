<?php
/* Smarty version 4.4.1, created on 2024-05-06 11:56:33
  from 'C:\Users\profesorado\OneDrive - iesaguadulce.es\I.E.S. Aguadulce 2023-2024\DWES\UT04\dwes04_sol\resources\templates\form_nuevo_taller.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.4.1',
  'unifunc' => 'content_6638a9517a4f07_45445206',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f82d4c5f7ba334ff37ca396bf55f23cdbce54927' => 
    array (
      0 => 'C:\\Users\\profesorado\\OneDrive - iesaguadulce.es\\I.E.S. Aguadulce 2023-2024\\DWES\\UT04\\dwes04_sol\\resources\\templates\\form_nuevo_taller.tpl',
      1 => 1709230590,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:errors.tpl' => 1,
  ),
),false)) {
function content_6638a9517a4f07_45445206 (Smarty_Internal_Template $_smarty_tpl) {
if ((isset($_smarty_tpl->tpl_vars['errores']->value))) {?>
    <?php $_smarty_tpl->_subTemplateRender('file:errors.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('contexto'=>'Errores al crear el taller','errores'=>$_smarty_tpl->tpl_vars['errores']->value), 0, false);
}
$_smarty_tpl->_assignInScope('dias', array('Lunes','Martes','Miércoles','Jueves','Viernes'));
$_smarty_tpl->_assignInScope('dia', max(0,min(4,date('w')-1)));?>
<form action="?accion=crear_taller" method="post">
    <label>Nombre: 
        <input id="nombre" type="text" name="nombre" 
               value="<?php echo htmlspecialchars((string)(($tmp = $_smarty_tpl->tpl_vars['datos']->value['nombre'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);?>
">
    </label><BR>
    <label>Descripcion: 
        <input id="descripcion" type="text" name="descripcion" 
               value="<?php echo htmlspecialchars((string)(($tmp = $_smarty_tpl->tpl_vars['datos']->value['descripcion'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);?>
">
    </label><BR>
    <label>Ubicacion: 
        <input id="ubicacion" type="text" name="ubicacion" 
               value="<?php echo htmlspecialchars((string)(($tmp = $_smarty_tpl->tpl_vars['datos']->value['ubicacion'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);?>
">
    </label><BR>
    <label>                
        Día de la semana: 
        <select name="dia_semana">
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['dias']->value, 'diasem', false, 'num');
$_smarty_tpl->tpl_vars['diasem']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['num']->value => $_smarty_tpl->tpl_vars['diasem']->value) {
$_smarty_tpl->tpl_vars['diasem']->do_else = false;
?>
                <option value="<?php echo $_smarty_tpl->tpl_vars['diasem']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['num']->value == $_smarty_tpl->tpl_vars['dia']->value) {?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['diasem']->value;?>
</option>
            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            <option value="ERROR" >ERROR</option>
        </select>
    </label><BR>
    <label>Hora de inicio: 
        <input id="hora_inicio" type="text" name="hora_inicio" 
               value="<?php echo htmlspecialchars((string)(($tmp = $_smarty_tpl->tpl_vars['datos']->value['hora_inicio'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);?>
">
    </label><BR>
    <label>Hora de fin: 
        <input id="hora_fin" type="text" name="hora_fin" 
               value="<?php echo htmlspecialchars((string)(($tmp = $_smarty_tpl->tpl_vars['datos']->value['hora_fin'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);?>
">
    </label><BR>
    <label>Cupo máximo: 
        <input id="cupo_maximo" type="text" name="cupo_maximo" 
               value="<?php echo htmlspecialchars((string)(($tmp = $_smarty_tpl->tpl_vars['datos']->value['cupo_maximo'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);?>
">
    </label><BR>
    <input type="submit" value="Enviar!">
</form><?php }
}
