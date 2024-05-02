<?php

define('EXPIRACION_SESSION',1800);

/*
 * Esta función es una función base de ejemplo. 
 * Lo adecuado es almacenar la información de usuario en una base de datos.
 */
function comprobarUsuario($usuario,$password)
{
    //Función de prueba
    if ($usuario==='usuario' && $password==='password')
    {
        $_SESSION['autenticado']['cuando']=time();
        $_SESSION['autenticado']['usuario']=$usuario;
        return true;
    }
    else
    {
        cerrarSesion();
        return false;
    }
}

function comprobarSiAutenticado()
{
    if (isset($_SESSION['autenticado']) &&
        time()-$_SESSION['autenticado']['cuando']<=EXPIRACION_SESSION)
        {
            $_SESSION['autenticado']['cuando']=time();
            return true;
        }
    else
        {
            cerrarSesion();
            return false;
        }
}

function cerrarSesion()
{
    unset($_SESSION['autenticado']);
    unset($_SESSION['datos']);
}