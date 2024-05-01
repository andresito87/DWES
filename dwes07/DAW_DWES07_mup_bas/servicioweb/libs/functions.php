<?php


function usuarioValido($usuario,$contraseña)
{
    if ($usuario.'*'===$contraseña) return true;
    else return false;
}