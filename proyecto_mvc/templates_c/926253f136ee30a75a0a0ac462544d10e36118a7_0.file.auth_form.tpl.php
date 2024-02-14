<?php
/* Smarty version 4.3.1, created on 2024-02-14 18:46:18
  from 'C:\xampp\htdocs\proyecto_mvc\templates\bloques\auth_form.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_65ccfc6a8d2959_07758268',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '926253f136ee30a75a0a0ac462544d10e36118a7' => 
    array (
      0 => 'C:\\xampp\\htdocs\\proyecto_mvc\\templates\\bloques\\auth_form.tpl',
      1 => 1682003690,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_65ccfc6a8d2959_07758268 (Smarty_Internal_Template $_smarty_tpl) {
?><form action="?accion=autenticar" method="post">
    <label>Usuario:<input type="text" name="username"></label>
    <label>Password:<input type="password" name="password"></label>
    <input type="submit" value="Autenticar">
</form><?php }
}
