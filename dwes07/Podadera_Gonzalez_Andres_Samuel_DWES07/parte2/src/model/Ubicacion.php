<?php

namespace DWES07\model;

require_once __DIR__ . '/../../libs/dbutil.php';

use \JsonSerializable;
use \PDOException;
use \PDO;


class Ubicacion
{
    private $id;
    private $nombre;
    private $descripcion;
    private $dias;

    public function __construct(string $nombre, string $descripcion, string $dias)
    {
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->dias = $dias;
    }

    public function getId() : int
    {
        return $this->id;
    }

    public function getNombre() : string
    {
        return $this->nombre;
    }

    public function getDescripcion() : string
    {
        return $this->descripcion;
    }

    public function getDias() : string
    {
        return $this->dias;
    }


    public const DIAS = ['L', 'M', 'X', 'J', 'V', 'S', 'D'];

    public static function listarUbicaciones(PDO $pdo) : array
    {
        $sql = <<<ENDSQL
            SELECT id, nombre, descripcion, dias
            FROM ubicaciones;
        ENDSQL;
        return doSQL($pdo, $sql);
    }

    public static function crearUbicacion(PDO $pdo, string $nombre, string $descripcion, string $dias) : bool
    {
        $sql = <<<ENDSQL
            INSERT INTO ubicaciones (nombre, descripcion, dias)
            VALUES (:nombre, :descripcion, :dias);
        ENDSQL;
        return doSQL($pdo, $sql, ['nombre' => $nombre, 'descripcion' => $descripcion, 'dias' => $dias]);
    }

    public static function obtenerUbicacion(PDO $pdo, int $id) : array
    {
        $sql = <<<ENDSQL
            SELECT id, nombre, descripcion, dias
            FROM ubicaciones
            WHERE id = :id;
        ENDSQL;
        return doSQL($pdo, $sql, ['id' => $id]);
    }

    public static function modificarUbicacion(PDO $pdo, string $nombre, string $descripcion, string $dias, int $id) : bool
    {
        $sql = <<<ENDSQL
            UPDATE ubicaciones
            SET nombre = :nombre, descripcion = :descripcion, dias = :dias
            WHERE id = :id;
        ENDSQL;
        return doSQL($pdo, $sql, ['nombre' => $nombre, 'descripcion' => $descripcion, 'dias' => $dias, 'id' => $id]);
    }

    public static function eliminarUbicacion(PDO $pdo, int $id) : bool
    {
        $sql = <<<ENDSQL
            DELETE FROM ubicaciones
            WHERE id = :id;
        ENDSQL;
        return doSQL($pdo, $sql, ['id' => $id]);
    }

}
