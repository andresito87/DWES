<?php
/* Smarty version 5.0.0-rc2, created on 2024-02-18 11:29:15
  from 'file:mostrarTalleres.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.0.0-rc2',
  'unifunc' => 'content_65d1ea0be6f019_58334202',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2d86ddc44e0f2eb1677c4c333f273b38ab9b5ed7' => 
    array (
      0 => 'mostrarTalleres.tpl',
      1 => 1708255751,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_65d1ea0be6f019_58334202 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/var/www/html/dwes04/plantillas';
?><style>
    table {
        border-collapse: collapse;
        width: 100%;
    }

    th,
    td {
        border: 1px solid black;
        text-align: center;
        padding: 4px;
    }

    th {
        background-color: #f2f2f2;
    }

    tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    tr:hover {
        background-color: #ffc5c5;
    }

    label {
        font-weight: 800;
    }

    form input[type="submit"] {
        background-color: #08fb2c;
        color: black;
        padding: 6px 10px;
        text-align: center;
        font-weight: 800;
        text-decoration: none;
        display: inline-block;
        font-size: 12px;
        margin: 4px 2px;
        cursor: pointer;
        border-radius: 4px;
    }

    form button[type="submit"] {
        background-color: #ff0e0e;
        color: black;
        font-weight: 800;
        padding: 6px 10px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 12px;
        margin: 4px 2px;
        cursor: pointer;
        border-radius: 4px;
    }
</style>
<h1>Listado de Talleres</h1>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Ubicación</th>
            <th>Día de la Semana</th>
            <th>Hora de Inicio</th>
            <th>Hora de Fin</th>
            <th>Cupo Máximo</th>
            <th>Eliminar</th>
        </tr>
    </thead>
    <tbody>
        <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('talleres'), 'taller');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('taller')->value) {
$foreach0DoElse = false;
?>
            <tr>
                <td><?php echo $_smarty_tpl->getValue('taller')->getId();?>
</td>
                <td><?php echo $_smarty_tpl->getValue('taller')->getNombre();?>
</td>
                <td><?php echo $_smarty_tpl->getValue('taller')->getDescripcion();?>
</td>
                <td><?php echo $_smarty_tpl->getValue('taller')->getUbicacion();?>
</td>
                <td><?php echo $_smarty_tpl->getValue('taller')->getDiaSemana();?>
</td>
                <td><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('date_format')($_smarty_tpl->getValue('taller')->getHoraInicio(),"%H:%M");?>
</td>
                <td><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('date_format')($_smarty_tpl->getValue('taller')->getHoraFin(),"%H:%M");?>
</td>
                <td><?php echo $_smarty_tpl->getValue('taller')->getCupoMaximo();?>
</td>
                <td>
                    <form action="index.php?accion=borrar_taller" method="post">
                        <input type="hidden" name="id" value="<?php echo $_smarty_tpl->getValue('taller')->getId();?>
">
                        <button type="submit" value="Eliminar">Eliminar</button>
                    </form>
                </td>
            </tr>
        <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
    </tbody>
</table><?php }
}
