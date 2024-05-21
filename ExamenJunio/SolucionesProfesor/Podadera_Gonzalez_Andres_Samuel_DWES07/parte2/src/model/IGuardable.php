<?php

namespace DWES07\model;

use \PDO;

/**
 * Interfaz común para todos los objetos del modelo.
 * Esta intefaz permite homogeneizar los nombres de los métodos entre
 * clases del modelo.
 */
interface IGuardable
{
    /**
     * Método de interfaz destinado a persistir en el almacenamiento
     * una entidad (instancia) del modelo.
     * @param PDO $pdo Conexión a la base de datos.
     */
    public function guardar(PDO $pdo) : bool|int;

    /**
     * Método de interfaz destinado a rescatar del almacenamiento una
     * entidad del modelo
     * @param PDO $pdo
     * @param int $id
     */
    public static function rescatar(PDO $pdo, int $id) : Ubicacion|bool;

    public static function borrar(PDO $pdo, int $id) : bool|int;
}