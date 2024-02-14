<?php
/* Smarty version 4.3.1, created on 2024-02-14 18:46:18
  from 'C:\xampp\htdocs\proyecto_mvc\templates\header.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_65ccfc6a8c7268_30763399',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '92a9871ed09f2b7beaa8e80c97902f7e5d00ef6f' => 
    array (
      0 => 'C:\\xampp\\htdocs\\proyecto_mvc\\templates\\header.tpl',
      1 => 1682102499,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:bloques/auth_logout.tpl' => 1,
    'file:bloques/auth_form.tpl' => 1,
    'file:bloques/notificaciones.tpl' => 1,
  ),
),false)) {
function content_65ccfc6a8c7268_30763399 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</title>
    <style>
        table {
        border-collapse: collapse;
        margin: 25px 0;
        font-size: 0.9em;
        font-family: sans-serif;
        min-width: 400px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
    }
    table thead tr {
        background-color: #009879;
        color: #ffffff;
        text-align: left;
    }
    table th,
    table td {
        padding: 12px 15px;
    }
    nav{
        width:100%;
        height:50px;
        text-align: right;
    }
    nav ul{
        display:inline-block;
        margin:0 auto;
    }
    nav li{
        display:inline-block;        
        padding-left: 10px;
    }

    nav li:not(:last-of-type){        
        padding-right: 10px;
        border-right: 1px solid black;
    }
    </style>
</head>
<body>
<nav>
<ul>
<?php if (!(isset($_smarty_tpl->tpl_vars['exclude']->value)) || strstr($_smarty_tpl->tpl_vars['exclude']->value,'principal') === false) {?>
    <li><a href="index.php">Ir a la página principal</a></li>
<?php }
if ((!(isset($_smarty_tpl->tpl_vars['exclude']->value)) || strstr($_smarty_tpl->tpl_vars['exclude']->value,'listfavs') === false) && (isset($_SESSION['usuario']))) {?>
    <li><a href="index.php?accion=listfavs">Ver productos favoritos</a></li>
<?php }
if ((isset($_SESSION['usuario']))) {?>
    <li>Bienvenido <?php echo $_SESSION['usuario']->getUsername();?>
.</li>
<?php }?>
<li>
<?php if ((isset($_SESSION['usuario']))) {?>
    <?php $_smarty_tpl->_subTemplateRender("file:bloques/auth_logout.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
} else { ?>
    <?php $_smarty_tpl->_subTemplateRender("file:bloques/auth_form.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>    
<?php }?>
</li>
</ul>
</nav>
<?php $_smarty_tpl->_subTemplateRender("file:bloques/notificaciones.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
