<?php

require_once __DIR__.'/dbutil.php';

/* Lista de funciones para autenticar a los usuarios */

//MODIFICACIÓN DE LA BASE DE DATOS, tabla EMPLEADOS
/* 
alter table empleados add column `password` varchar(128);
update empleados set password=SHA2(concat(`dni`,'test',reverse(concat(`dni`,'test')),'495k5ndikakzFSKZssd'),256) WHERE id>=0;
UPDATE empleados SET nombre='Encarnación', apellidos='López Pérez' where id=3;
UPDATE empleados SET nombre='Felípe', apellidos='Ruíz Alonso' where id=5;

*/

define('ROL_ADMIN','admin');
define('ROL_COORD','coord');
define('ROL_TRASOC','trasoc');
define('ROL_EDUSOC','edusoc');


/**
 * Función que permite construir una cadena que mezcla usuario, contraseña y un
 * texto adicional (SALT) para luego aplicarle un hash de forma más eficiente.
 */
function componerAuthStr(string $dni, string $password):string
{
    return $dni.$password.strrev($dni.$password).SALT;
}

function verificarEmpleado(PDO $pdo, string $dni, string $password)
{
    $authstr=componerAuthStr($dni,$password);
    $sql="SELECT id,dni,nombre,apellidos,roles from empleados where dni=:dni and password=SHA2(:authstr,256)";
    return doSql($pdo, $sql,[':dni'=>$dni,':authstr'=>$authstr],true);        
}

function modificarPassword(PDO $pdo, string $dni, string $currentpassword, string $newpassword)
{
    $currentauthstr=componerAuthStr($dni,$currentpassword);
    $newauthstr=componerAuthStr($dni,$newpassword);
    $sql="UPDATE empleados SET password=SHA2(:newauthstr,256) WHERE dni=:dni and password=SHA2(:currentauthstr,256)";
    return doSql($pdo, $sql,[':dni'=>$dni,':newauthstr'=>$newauthstr,':currentauthstr'=>$currentauthstr]);        
}


function tieneRol($rol):bool
{
    if (isset($_SESSION['empleado']) && strpos($_SESSION['empleado']['roles'],$rol)!==false) return true;
    else return false;
}

function comprobarSiSeguimientoEsDeEmpleado ($pdo, $idseguimiento,$idempleado):bool
{
    $sql="SELECT count(*) as recuento FROM seguimiento WHERE id=:idseguimiento AND empleados_id=:idempleado";
    $x=doSQL($pdo,$sql,["idseguimiento"=>$idseguimiento,'idempleado'=>$idempleado],true);
    if (is_array($x)) return $x['recuento']===1;
    else return false;
}   