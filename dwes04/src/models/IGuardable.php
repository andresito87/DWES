<?php

namespace DWES04\models;

use PDO;

/**
 * Interfaz que define los métodos que deben implementar las clases que se pueden crear, leer y borrar en la base de datos.
 * 
 * La implementación de esta interfaz en las clases permite que los objetos creados a partir de dichas clases puedan guardados,
 * rescatados y borrados de la base de datos. Faltaría añadir un método actualizar para completar lo que sería un CRUD.
 * 
 * @package DWES04\models
 * @author Andrés Samuel Podadera González
 * @uses PDO https://www.php.net/manual/es/class.pdo.php
 * @version 1.0
 */
interface IGuardable
{
    public function guardar(PDO $con);
    public static function rescatar(PDO $con, int $id);
    public static function borrar(PDO $con, int $id);
}