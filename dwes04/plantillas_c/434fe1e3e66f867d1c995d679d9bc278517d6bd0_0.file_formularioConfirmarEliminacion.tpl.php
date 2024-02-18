<?php
/* Smarty version 5.0.0-rc2, created on 2024-02-18 11:36:48
  from 'file:formularioConfirmarEliminacion.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.0.0-rc2',
  'unifunc' => 'content_65d1ebd008a4b5_67199183',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '434fe1e3e66f867d1c995d679d9bc278517d6bd0' => 
    array (
      0 => 'formularioConfirmarEliminacion.tpl',
      1 => 1708256203,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_65d1ebd008a4b5_67199183 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/var/www/html/dwes04/plantillas';
?><style>
    form {
        margin: 20px;
        font-size: large;
        font-weight: bold;
    }

    label {
        margin: 10px;
    }

    input {
        margin: 10px;
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

<div>
    <form action="index.php?accion=borrar_taller" method="post"><label for="confirmar">Marque la casilla de verificación
            para confirmar la eliminación</label><input type="hidden" name="id" value="<?php echo $_smarty_tpl->getValue('id');?>
">
        <input type="checkbox" id="eliminar" name="eliminar" value="eliminar">
        <br>
        <input type="submit" value="Confirmar elimninación">
    </form>
</div><?php }
}
