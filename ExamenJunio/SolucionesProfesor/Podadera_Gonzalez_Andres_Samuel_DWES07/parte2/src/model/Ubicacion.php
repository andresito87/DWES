<?php

namespace DWES07\model;

use \JsonSerializable;
use \PDOException;
use \PDO;


class Ubicacion extends Modelo
{
    public const DIAS = ['L', 'M', 'X', 'J', 'V', 'S', 'D'];

    public const NULLABLE_FIELDS = ['id', 'nombre', 'descripcion', 'dias'];
    private ?int $id = null;
    private ?string $nombre = null;
    private ?string $descripcion = null;
    private ?string $dias = null;

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

    public function setId($id) : bool
    {
        $this->id = $id;
        return true;
    }

    public function setNombre(string $nombre) : bool
    {
        if (! isset($nombre) || ! is_string($nombre))
            return false;
        $this->nombre = $nombre;
        return true;
    }

    public function setDescripcion(string $descripcion) : bool
    {
        if (! isset($descripcion) || ! is_string($descripcion))
            return false;
        $this->descripcion = $descripcion;
        return true;
    }

    public function setDias(string $dias) : bool
    {
        if (! isset($dias) || ! is_string($dias))
            return false;
        $this->dias = $dias;
        return true;
    }


    /**
     *
     * @param PDO $pdo
     * @param int $id
     * @return bool|int
     */
    public static function borrar(PDO $pdo, int $id) : bool|int
    {
        $SQL = "DELETE FROM ubicaciones WHERE id=:id";
        try {
            $stmt = $pdo->prepare($SQL);
            $stmt->bindValue('id', $id);
            if ($stmt->execute()) {
                return $stmt->rowCount();
            }
        } catch (PDOException $ex) {
            var_dump($ex);
        }
        return false;
    }

    /**
     * Método de interfaz destinado a persistir en el almacenamiento
     * una entidad (instancia) del modelo.
     *
     * @param PDO $pdo Conexión a la base de datos.
     */
    public function guardar(PDO $pdo) : bool|int
    {
        //Miro en la base de datos si existe la ubicación
        $SQL = "SELECT * FROM ubicaciones WHERE id=:id";
        $stmt = $pdo->prepare($SQL);
        $stmt->bindValue('id', $this->id);
        $stmt->execute();
        $resultado = $stmt->fetchObject(Ubicacion::class);
        if ($resultado instanceof Ubicacion) {
            $SQL = "UPDATE ubicaciones SET nombre=:nombre, descripcion=:descripcion, dias=:dias WHERE id=:id";
            $stmt = $pdo->prepare($SQL);
            $stmt->bindValue('id', $this->id);
            $stmt->bindValue('nombre', $this->nombre);
            $stmt->bindValue('descripcion', $this->descripcion);
            $stmt->bindValue('dias', $this->dias);
            if ($stmt->execute()) {
                return $stmt->rowCount();
            }
        } else {
            $SQL = "INSERT INTO ubicaciones (nombre, descripcion, dias) VALUES (:nombre, :descripcion, :dias)";
            $stmt = $pdo->prepare($SQL);
            $stmt->bindValue('nombre', $this->nombre);
            $stmt->bindValue('descripcion', $this->descripcion);
            $stmt->bindValue('dias', $this->dias);
            if ($stmt->execute()) {
                return $pdo->lastInsertId();
            }
        }
        return false;
    }

    /**
     * Método de interfaz destinado a rescatar del almacenamiento una
     * entidad del modelo
     *
     * @param PDO $pdo
     * @param int $id
     * @return bool|int|Modelo
     */
    public static function rescatar(PDO $pdo, int $id) : Ubicacion|bool
    {
        $SQL = "SELECT * FROM ubicaciones WHERE id=:id";
        $resultado = false;
        try {
            $stmt = $pdo->prepare($SQL);
            $stmt->bindValue('id', $id);
            if ($stmt->execute())
                $resultado = $stmt->fetchObject(Ubicacion::class);
            if ($resultado instanceof Ubicacion) {
                $id_taller = $resultado->getId();
                $resultado->setId($id_taller);
                unset($id_taller);
            }
        } catch (PDOException $ex) {
            var_dump($ex);
        }
        return $resultado;
    }
}
