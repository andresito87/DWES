<?php

/* Lista de funciones para autenticar a los usuarios */

//MODIFICACIÓN DE LA BASE DE DATOS, tabla EMPLEADOS
/*
alter table empleados add column `password` varchar(128);
update empleados set password=SHA2(concat(`dni`,'test',reverse(concat(`dni`,'test')),'495k5ndikakzFSKZssd'),256) WHERE id>=0;
UPDATE empleados SET nombre='Encarnación', apellidos='López Pérez' where id=3;
UPDATE empleados SET nombre='Felípe', apellidos='Ruíz Alonso' where id=5;

*/
namespace DWES07\model;

use \PDO;
use \PDOException;
use \DB;

class Empleado
{

    const ROL_ADMIN = 'admin';
    const ROL_COORD = 'coord';
    const ROL_TRASOC = 'trasoc';
    const ROL_ROL_EDUSOC = 'edusoc';


    /**
     * Función que permite construir una cadena que mezcla usuario, contraseña y un
     * texto adicional (SALT) para luego aplicarle un hash de forma más eficiente.
     */
    private static function componerAuthStr(string $dni, string $password): string
    {
        return $dni . $password . strrev($dni . $password) . SALT;
    }

    public static function verificarEmpleado(PDO $pdo, string $dni, string $password)
    {
        $authstr = static::componerAuthStr($dni, $password);
        $sql = "SELECT id,dni,nombre,apellidos,roles from empleados where dni=:dni and password=SHA2(:authstr,256)";
        return DB::doSql($pdo, $sql, [':dni' => $dni, ':authstr' => $authstr], true);
    }

    public static function modificarPassword(PDO $pdo, string $dni, string $currentpassword, string $newpassword)
    {
        $currentauthstr = static::componerAuthStr($dni, $currentpassword);
        $newauthstr = static::componerAuthStr($dni, $newpassword);
        $sql = "UPDATE empleados SET password=SHA2(:newauthstr,256) WHERE dni=:dni and password=SHA2(:currentauthstr,256)";
        return DB::doSql($pdo, $sql, [':dni' => $dni, ':newauthstr' => $newauthstr, ':currentauthstr' => $currentauthstr]);
    }

}
