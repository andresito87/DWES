<?php
/* Smarty version 4.4.1, created on 2024-05-06 11:56:14
  from 'C:\Users\profesorado\OneDrive - iesaguadulce.es\I.E.S. Aguadulce 2023-2024\DWES\UT04\dwes04_sol\resources\templates\listar_talleres.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.4.1',
  'unifunc' => 'content_6638a93e4ef6a9_81806378',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '292c11c3e9a0ca8d700e90448bfc158433d82413' => 
    array (
      0 => 'C:\\Users\\profesorado\\OneDrive - iesaguadulce.es\\I.E.S. Aguadulce 2023-2024\\DWES\\UT04\\dwes04_sol\\resources\\templates\\listar_talleres.tpl',
      1 => 1709229669,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6638a93e4ef6a9_81806378 (Smarty_Internal_Template $_smarty_tpl) {
if ((isset($_smarty_tpl->tpl_vars['talleres']->value)) && count($_smarty_tpl->tpl_vars['talleres']->value) > 0) {?>
    <form action="">
        Dia de la semana: <input type="text" name="dia_semana" value="">
        <input type="submit" value="Filtrar!">
    </form>
<table border="1" cellspacing="0" cellpadding="10px">
    <thead>
        <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Descripcion</th>
            <th>Ubicacion</th>
            <th>Dia de la semana</th>
            <th>Hora de Inicio</th>
            <th>Hora de Fin</th>
            <th>Cupo</th>
            <th>Operaciones</th>
        </tr>
    </thead>
    <tbody>
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['talleres']->value, 'taller');
$_smarty_tpl->tpl_vars['taller']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['taller']->value) {
$_smarty_tpl->tpl_vars['taller']->do_else = false;
?>
        <tr>
            <td><?php echo $_smarty_tpl->tpl_vars['taller']->value->getId();?>
</td>
            <td><?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['taller']->value->getNombre(), ENT_QUOTES, 'UTF-8', true);?>
</td>
            <td><?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['taller']->value->getDescripcion(), ENT_QUOTES, 'UTF-8', true);?>
</td>
            <td><?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['taller']->value->getUbicacion(), ENT_QUOTES, 'UTF-8', true);?>
</td>
            <td><?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['taller']->value->getDia_semana(), ENT_QUOTES, 'UTF-8', true);?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['taller']->value->getHora_inicio();?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['taller']->value->getHora_fin();?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['taller']->value->getCupo_maximo();?>
</td>
            <td>
                <form action="?accion=borrar_taller" method="POST">
                    <input type="hidden" name="id_taller" value="<?php echo $_smarty_tpl->tpl_vars['taller']->value->getId();?>
">
                    <input type="submit" value="¡Eliminar!">
                </form>                
            </td>
        </tr>
        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    </tbody>
</table>
<?php } else { ?>
    <h3>No hay talleres.</h3>
<?php }?>
<A href="?accion=nuevo_taller_form">Crear nuevo taller</a>
<A href="index.php">Listar todos los talleres</a><?php }
}
