<?php
/* Smarty version 5.0.0-rc2, created on 2024-02-17 14:36:12
  from 'file:confirmacionEliminacion.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.0.0-rc2',
  'unifunc' => 'content_65d0c45cefb690_34129800',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '5fe3f93ba636750fd51102af5419d450dffa4abd' => 
    array (
      0 => 'confirmacionEliminacion.tpl',
      1 => 1708180568,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_65d0c45cefb690_34129800 (\Smarty\Template $_smarty_tpl) {
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
